<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Test;
use App\Models\Report;

class UpdateReportsTestID extends Command
{
    protected $signature = 'reports:update-test-id';
    protected $description = 'Update test_id in reports based on matching test name';

    public function handle()
    {
        $reports = Report::all();

        foreach ($reports as $report) {
            $matchingTest = Test::where('test_name', $report->test_names)->first();

            if ($matchingTest) {
                $report->test_id = $matchingTest->id;
                $report->save();
            }
        }

        $this->info('Reports updated successfully');
    }
}






