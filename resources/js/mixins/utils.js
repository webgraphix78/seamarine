import { DateTime } from "luxon";
import * as bootstrap from "bootstrap";

export default {
    data() {
        return {};
    },
    mounted() {},
    methods: {
        validateEmail(emailString) {
            // Pending email regex
            return emailString && emailString.length > 0;
        },
        validatePhone(phoneString) {
            return (
                phoneString &&
                phoneString.length > 0 &&
                /^\d{5,}$/gi.test(phoneString)
            );
        },
        formatMySQLDate(targetDate, dateFormat) {
            return DateTime.fromSQL(targetDate).toFormat(dateFormat);
        },
        formatISODate(targetDate, dateFormat) {
            return DateTime.fromISO(targetDate).toFormat(dateFormat);
        },
        today() {
            return new DateTime(new Date()).toFormat("yyyy-MM-dd");
        },
        tomorrow() {
            return new DateTime(new Date()).toFormat("yyyy-MM-dd");
        },
        currentMonth() {
            return new DateTime(new Date()).toFormat("yyyy-MM-01");
        },
        minutesAgo(isoDate) {
            const targetDate = new Date(isoDate);
            const currentDate = new Date();
            const timeDifference = currentDate - targetDate;
            return Math.floor(timeDifference / 1000 / 60);
		},
		isEmptyString(value) {
			return (value == null || (typeof value === "string" && value.trim().length === 0));
		},
		closeAllModals() {
			const $modals =  document.querySelectorAll('.modal')
			$modals.forEach(modal => {
				let currentModal = bootstrap.Modal.getInstance(modal)
				if (currentModal) currentModal.hide()
			})
		},
		// Compress image file size only, keeping original dimensions
		async compressImage(file, maxSizeMB = 1.5) {
			return new Promise((resolve, reject) => {
				const reader = new FileReader();
				reader.readAsDataURL(file);
				reader.onload = (event) => {
					const img = new Image();
					img.src = event.target.result;
					img.onload = () => {
						const canvas = document.createElement('canvas');
						canvas.width = img.width;
						canvas.height = img.height;

						const ctx = canvas.getContext('2d');
						
						// For PNG, fill with white background before drawing
						// (only if converting to JPEG)
						if (file.type === "image/png") {
							ctx.fillStyle = '#FFFFFF';
							ctx.fillRect(0, 0, canvas.width, canvas.height);
						}
						
						ctx.drawImage(img, 0, 0, img.width, img.height);

						let quality = 0.9;
						const maxSize = maxSizeMB * 1024 * 1024;
						
						// Always use JPEG for compression (best compression ratio)
						const outputType = "image/jpeg";
						const fileName = file.name.replace(/\.(png|jpg|jpeg)$/i, '.jpg');
						
						const tryCompress = () => {
							canvas.toBlob((blob) => {
								if (blob.size > maxSize && quality > 0.1) {
									quality -= 0.1;
									tryCompress();
								} else {
									const compressedFile = new File([blob], fileName, {
										type: outputType,
										lastModified: Date.now()
									});
									resolve(compressedFile);
								}
							}, outputType, quality);
						};

						tryCompress();
					};
					img.onerror = reject;
				};
				reader.onerror = reject;
			});
		},
    },
};
