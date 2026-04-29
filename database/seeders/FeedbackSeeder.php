<?php

namespace Database\Seeders;

use App\Models\FeedbackCategory;
use App\Models\FeedbackPriority;
use App\Models\FeedbackStatus;
use App\Models\FeedbackType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeedbackSeeder extends Seeder
{
    public function run(): void
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('feedback_ai_logs')->truncate();
        DB::table('feedback_attachments')->truncate();
        DB::table('feedback_comments')->truncate();
        DB::table('feedbacks')->truncate();
        DB::table('feedback_categories')->truncate();
        DB::table('feedback_priorities')->truncate();
        DB::table('feedback_statuses')->truncate();
        DB::table('feedback_types')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $types = [
            ['Concern', 'danger'],
            ['Complaint', 'danger'],
            ['Suggestion', 'info'],
            ['Appreciation', 'success'],
            ['Maintenance Request', 'warning'],
            ['Security Concern', 'danger'],
            ['Billing Concern', 'warning'],
            ['Inquiry', 'info'],
            ['Other', 'gray'],
        ];

        foreach ($types as [$name, $color]) {
            FeedbackType::firstOrCreate(
                ['name' => $name],
                ['color' => $color, 'is_active' => true]
            );
        }

        $statuses = [
            ['Submitted', 'gray'],
            ['Under Review', 'info'],
            ['Assigned', 'warning'],
            ['In Progress', 'warning'],
            ['Resolved', 'success'],
            ['Closed', 'gray'],
            ['Cancelled', 'danger'],
        ];

        foreach ($statuses as [$name, $color]) {
            FeedbackStatus::firstOrCreate(
                ['name' => $name],
                ['color' => $color]
            );
        }

        $priorities = [
            ['Emergency', 'danger', 1],
            ['High', 'danger', 2],
            ['Medium', 'warning', 3],
            ['Low', 'success', 4],
        ];

        foreach ($priorities as [$name, $color, $sortOrder]) {
            FeedbackPriority::firstOrCreate(
                ['name' => $name],
                ['color' => $color, 'sort_order' => $sortOrder]
            );
        }

        $categories = [
            ['Security', 'danger'],
            ['Maintenance', 'warning'],
            ['Billing', 'info'],
            ['Amenities', 'success'],
            ['Sanitation', 'warning'],
            ['Water Supply', 'info'],
            ['Electrical', 'warning'],
            ['Noise Complaint', 'danger'],
            ['Parking', 'warning'],
            ['Community Suggestion', 'info'],
            ['Positive Feedback', 'success'],
            ['Other', 'gray'],
        ];

        foreach ($categories as [$name, $color]) {
            FeedbackCategory::firstOrCreate(
                ['name' => $name],
                ['color' => $color, 'is_active' => true]
            );
        }

        $now = Carbon::now();

        $records = [
            [
                'user_id'                => 2,
                'homeowner_profile_id'   => 1,
                'property_id'            => 1,
                'subdivision_phase_id'   => 1,
                'street_id'              => 5, // Fir
                'feedback_type_id'       => 5, // Maintenance Request
                'feedback_category_id'   => 2, // Maintenance
                'feedback_status_id'     => 4, // In Progress
                'feedback_priority_id'   => 2, // High
                'assigned_to'            => null,
                'reference_no'           => 'FB-0000001',
                'title'                  => 'Streetlight out on Block 3',
                'message'                => 'The streetlight near Block 3, Lot 12 has been out for a week now. Very dark at night and feels unsafe for residents walking home.',
                'location_label'         => 'Block 3, Lot 12',
                'block_no'               => '3',
                'lot_no'                 => '12',
                'is_anonymous'           => false,
                'is_emergency'           => false,
                'is_public'              => true,
                'submitted_at'           => $now->copy()->subDays(5),
                'reviewed_at'            => null,
                'assigned_at'            => $now->copy()->subDays(4),
                'resolved_at'            => null,
                'closed_at'              => null,
                'admin_notes'            => null,
                'created_at'             => $now->copy()->subDays(5),
                'updated_at'             => $now->copy()->subDays(4),
            ],
            [
                'user_id'                => 2,
                'homeowner_profile_id'   => 1,
                'property_id'            => 1,
                'subdivision_phase_id'   => 1,
                'street_id'              => 1, // Buenmar Ave
                'feedback_type_id'       => 1, // Concern
                'feedback_category_id'   => 5, // Sanitation
                'feedback_status_id'     => 5, // Resolved
                'feedback_priority_id'   => 3, // Medium
                'assigned_to'            => null,
                'reference_no'           => 'FB-0000002',
                'title'                  => 'Missed garbage collection',
                'message'                => 'Garbage was not collected on Main Avenue Circle last Thursday. The bins are overflowing and attracting pests.',
                'location_label'         => 'Main Avenue Circle',
                'block_no'               => null,
                'lot_no'                 => null,
                'is_anonymous'           => false,
                'is_emergency'           => false,
                'is_public'              => true,
                'submitted_at'           => $now->copy()->subDays(10),
                'reviewed_at'            => $now->copy()->subDays(9),
                'assigned_at'            => null,
                'resolved_at'            => $now->copy()->subDays(8),
                'closed_at'              => null,
                'admin_notes'            => 'Coordinated with sanitation team. Issue resolved.',
                'created_at'             => $now->copy()->subDays(10),
                'updated_at'             => $now->copy()->subDays(8),
            ],
            [
                'user_id'                => 1,
                'homeowner_profile_id'   => null,
                'property_id'            => null,
                'subdivision_phase_id'   => null,
                'street_id'              => null,
                'feedback_type_id'       => 6, // Security Concern
                'feedback_category_id'   => 1, // Security
                'feedback_status_id'     => 3, // Assigned
                'feedback_priority_id'   => 1, // Emergency
                'assigned_to'            => 1,
                'reference_no'           => 'FB-0000003',
                'title'                  => 'Suspicious vehicle parked at gate',
                'message'                => 'There is a suspicious vehicle with no plate that has been parked near the entrance gate since yesterday morning. Security guard seems unaware.',
                'location_label'         => 'Main Entrance Gate',
                'block_no'               => null,
                'lot_no'                 => null,
                'is_anonymous'           => false,
                'is_emergency'           => true,
                'is_public'              => false,
                'submitted_at'           => $now->copy()->subDays(1),
                'reviewed_at'            => $now->copy()->subHours(6),
                'assigned_at'            => $now->copy()->subHours(3),
                'resolved_at'            => null,
                'closed_at'              => null,
                'admin_notes'            => null,
                'created_at'             => $now->copy()->subDays(1),
                'updated_at'             => $now->copy()->subHours(3),
            ],
            [
                'user_id'                => 2,
                'homeowner_profile_id'   => 1,
                'property_id'            => 1,
                'subdivision_phase_id'   => 1,
                'street_id'              => 5, // Fir
                'feedback_type_id'       => 3, // Suggestion
                'feedback_category_id'   => 10, // Community Suggestion
                'feedback_status_id'     => 2, // Under Review
                'feedback_priority_id'   => 4, // Low
                'assigned_to'            => null,
                'reference_no'           => 'FB-0000004',
                'title'                  => 'Install speed bumps near playground',
                'message'                => 'Vehicles tend to speed near the playground area. Installing speed bumps would greatly improve safety for children playing in the area.',
                'location_label'         => 'Playground Area, Block 7',
                'block_no'               => '7',
                'lot_no'                 => null,
                'is_anonymous'           => false,
                'is_emergency'           => false,
                'is_public'              => true,
                'submitted_at'           => $now->copy()->subDays(3),
                'reviewed_at'            => $now->copy()->subDays(2),
                'assigned_at'            => null,
                'resolved_at'            => null,
                'closed_at'              => null,
                'admin_notes'            => null,
                'created_at'             => $now->copy()->subDays(3),
                'updated_at'             => $now->copy()->subDays(2),
            ],
            [
                'user_id'                => 2,
                'homeowner_profile_id'   => 1,
                'property_id'            => 1,
                'subdivision_phase_id'   => 1,
                'street_id'              => 5, // Fir
                'feedback_type_id'       => 4, // Appreciation
                'feedback_category_id'   => 11, // Positive Feedback
                'feedback_status_id'     => 6, // Closed
                'feedback_priority_id'   => 4, // Low
                'assigned_to'            => null,
                'reference_no'           => 'FB-0000005',
                'title'                  => 'Thank you for the clean-up drive',
                'message'                => 'I would like to commend the HOA team for organizing the recent clean-up drive. The subdivision looks so much cleaner now. Keep it up!',
                'location_label'         => null,
                'block_no'               => null,
                'lot_no'                 => null,
                'is_anonymous'           => false,
                'is_emergency'           => false,
                'is_public'              => true,
                'submitted_at'           => $now->copy()->subDays(15),
                'reviewed_at'            => $now->copy()->subDays(15),
                'assigned_at'            => null,
                'resolved_at'            => null,
                'closed_at'              => $now->copy()->subDays(14),
                'admin_notes'            => 'Acknowledged. Forwarded to HOA president.',
                'created_at'             => $now->copy()->subDays(15),
                'updated_at'             => $now->copy()->subDays(14),
            ],
            [
                'user_id'                => 2,
                'homeowner_profile_id'   => 1,
                'property_id'            => 1,
                'subdivision_phase_id'   => 1,
                'street_id'              => 5, // Fir
                'feedback_type_id'       => 7, // Billing Concern
                'feedback_category_id'   => 3, // Billing
                'feedback_status_id'     => 1, // Submitted
                'feedback_priority_id'   => 3, // Medium
                'assigned_to'            => null,
                'reference_no'           => 'FB-0000006',
                'title'                  => 'Association due amount discrepancy',
                'message'                => 'My billing statement shows a different amount from what was announced during the last homeowners meeting. Please clarify the correct amount for 2026.',
                'location_label'         => null,
                'block_no'               => null,
                'lot_no'                 => null,
                'is_anonymous'           => false,
                'is_emergency'           => false,
                'is_public'              => false,
                'submitted_at'           => $now->copy()->subHours(6),
                'reviewed_at'            => null,
                'assigned_at'            => null,
                'resolved_at'            => null,
                'closed_at'              => null,
                'admin_notes'            => null,
                'created_at'             => $now->copy()->subHours(6),
                'updated_at'             => $now->copy()->subHours(6),
            ],
            [
                'user_id'                => 1,
                'homeowner_profile_id'   => null,
                'property_id'            => null,
                'subdivision_phase_id'   => 1,
                'street_id'              => 5, // Fir
                'feedback_type_id'       => 2, // Complaint
                'feedback_category_id'   => 8, // Noise Complaint
                'feedback_status_id'     => 4, // In Progress
                'feedback_priority_id'   => 2, // High
                'assigned_to'            => null,
                'reference_no'           => 'FB-0000007',
                'title'                  => 'Noisy construction on rest days',
                'message'                => 'A neighbor on Block 5 has been doing heavy construction work every Sunday since last month. Noise starts as early as 6 AM and violates the subdivision rules.',
                'location_label'         => 'Block 5, Lot 8',
                'block_no'               => '5',
                'lot_no'                 => '8',
                'is_anonymous'           => false,
                'is_emergency'           => false,
                'is_public'              => false,
                'submitted_at'           => $now->copy()->subDays(7),
                'reviewed_at'            => $now->copy()->subDays(7),
                'assigned_at'            => $now->copy()->subDays(6),
                'resolved_at'            => null,
                'closed_at'              => null,
                'admin_notes'            => null,
                'created_at'             => $now->copy()->subDays(7),
                'updated_at'             => $now->copy()->subDays(6),
            ],
        ];



        DB::table('feedbacks')->insert($records);
    }
}
