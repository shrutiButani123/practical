## About Laravel
# Login
# Registration
# Seeder
# City and State jquery 
# middleware UserIsVerified = Verified User only login
# middleware CheckAuthenticated

## Event Listner
# make event listener command- 
 # php artisan make:event SendMail
 # php artisan make:listener SendMailFired --event="SendMail"
 # EventServiceProvider in register the event and listener

## Laravel provides two ways to automate tasks:
# Laravel Command (php artisan make:command)
# Laravel Cron Job (Scheduling commands using schedule() in Kernel.php)

## Command
# make command - 
  # php artisan make:command DeleteOldUsers --command=delete:users
# run command and delete the user - php artisan delete:user

## If you run command automatic use schedule
# kernal.php file configration
# run command and delete the user - php artisan schedule:run