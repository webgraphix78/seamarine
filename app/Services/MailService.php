<?php
namespace App\Services;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class MailService{

	// private static function setMailSettings(){
		// config(['mail.mailers.smtp.host' => $settings["smtp_host"]]);
		// config(['mail.mailers.smtp.port' => $settings["smtp_port"]]);
		// config(['mail.mailers.smtp.encryption' => $settings["smtp_encryption"]]);
		// config(['mail.mailers.smtp.username' => $settings["smtp_username"]]);
		// config(['mail.mailers.smtp.password' => $settings["smtp_password"]]);
		// config(['mail.mailers.smtp.from.address' => $settings["smtp_from_email_address"]]);
		// config(['mail.mailers.smtp.from.name' => $settings["smtp_from_name"]]);
	// }

	public static function notifyClientForCleaningReport($email, $cleaningData){
		// Now send email
		try {
			log::info("Sending to ".$email);
			Mail::to("jayvpagnis@gmail.com")->send(new \App\Mail\CleaningMail($cleaningData));
			log::info("Email sent to ".$email);
		} catch (\Throwable $th) {
			throw $th;
		}
	}
}