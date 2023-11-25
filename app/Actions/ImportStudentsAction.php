<?php

namespace App\Actions;

use App\Models\Student;
use App\Notifications\StudentAccountCreated;
use App\Traits\Makeable;
use Filament\Notifications\Notification;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ImportStudentsAction
{
    use Makeable;

    public function handle(array $data): bool
    {
        try {
            $data = collect($data);

            foreach ($data as $stud) {
                $randomPassword = Str::random(8);

                $student = Student::create([
                    'registration_no' => $stud['registration_no'],
                    'name' => $stud['name'],
                    'email' => $stud['email'],
                    'password' => Hash::make($randomPassword),
                ]);

                $student->notify(new StudentAccountCreated($randomPassword));
            }

            Notification::make()
                ->title('Students Imported')
                ->body('Imported '.$data->count().' students.')
                ->success()
                ->send();

            return true;
        } catch (\Exception $e) {
            $message = 'An error occured while importing students. Please check the CSV file and try again.';

            if ($e instanceof UniqueConstraintViolationException) {
                $message = 'Cannot import. Duplicate registration numbers found.';
            }

            Log::error($e->getMessage(), ['trace' => $e->getTraceAsString()]);

            Notification::make()
                ->title('An error occured')
                ->body($message)
                ->color('danger')
                ->send();

            return false;
        }
    }
}
