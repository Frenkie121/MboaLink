<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $free = Subscription::create([
            'name' => 'Free',
            'amount' => 0,
            'duration' => 24,
        ]);

        $company = Subscription::create([
            'name' => 'Company',
            'amount' => 5000,
            'duration' => 4,
        ]);

        $student = Subscription::create([
            'name' => 'Student',
            'amount' => 2500,
            'duration' => 4,
        ]);

        $pupil = Subscription::create([
            'name' => 'Pupil',
            'amount' => 1000,
            'duration' => 4,
        ]);

        $unemployed = Subscription::create([
            'name' => 'Unemployed',
            'amount' => 5000,
            'duration' => 4,
        ]);

        // COMPANY CONTENTS
        $companyContents = [
            'Permanent notification of any useful information',
            "Unlimited access to the best profiles corresponding to the characteristics you're looking for",
            'Guaranteed in-depth evaluation of every candidate likely to meet your selection criteria',
            'Access to the evaluation file of every candidate you select for job interviews and internships'
        ];

        $studentContents = [
            'Permanent notification of available internships and/or jobs corresponding to your profile',
            'Support in the integration process of structures potentially interested in welcoming you',
            'Ongoing advice and follow-up',
            'Psychological support'
        ];

        $pupilContents = [
            'Permanent notification of available internships matching your profile',
            'Permanent advice and follow-up',
            'Psychological support'
        ];

        $unemployedContents = [
            'Permanent notification of available job offers matching your profile',
            'Strategic advice on your career orientations according to your aptitudes',
            'We determine through an in-depth survey your possible compatibility or not with companies sensitive to your profile',
            'Tips and advice on how to prepare for your job interviews'
        ];

        $freeContents = [
            'View all job offers and apply (job or internship seekers)',
            'Post job offers (company)'
        ];

        foreach ($companyContents as $content) {
            $company->offers()->create([
                'content' => $content,
            ]);
        }

        foreach ($studentContents as $content) {
            $student->offers()->create([
                'content' => $content,
            ]);
        }

        foreach ($pupilContents as $content) {
            $pupil->offers()->create([
                'content' => $content,
            ]);
        }

        foreach ($unemployedContents as $content) {
            $unemployed->offers()->create([
                'content' => $content,
            ]);
        }

        foreach ($freeContents as $content) {
            $free->offers()->create([
                'content' => $content,
            ]);
        }
    }
}
