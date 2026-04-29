<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\City;
use App\Models\OccupancyStatus;
use App\Models\Property;
use App\Models\PropertyStatus;
use App\Models\PropertyType;
use App\Models\Street;
use App\Models\SubdivisionPhase;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PlaceOwnerSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Reset Tables
        |--------------------------------------------------------------------------
        */
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('property_occupancies')->truncate();
        DB::table('property_ownerships')->truncate();
        DB::table('homeowner_profiles')->truncate();
        DB::table('occupancy_types')->truncate();
        DB::table('properties')->truncate();

        DB::table('streets')->truncate();
        DB::table('subdivision_phases')->truncate();
        DB::table('areas')->truncate();
        DB::table('cities')->truncate();

        DB::table('property_statuses')->truncate();
        DB::table('occupancy_statuses')->truncate();
        DB::table('property_types')->truncate();

        // DB::table('users')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::transaction(function () {
            /*
            |--------------------------------------------------------------------------
            | Property Types
            |--------------------------------------------------------------------------
            */
            $lotType = PropertyType::create([
                'name' => 'Lot',
                'code' => 'lot',
                'is_active' => true,
            ]);

            PropertyType::create([
                'name' => 'House & Lot',
                'code' => 'house_lot',
                'is_active' => true,
            ]);

            PropertyType::create([
                'name' => 'Townhouse',
                'code' => 'townhouse',
                'is_active' => true,
            ]);

            PropertyType::create([
                'name' => 'Apartment',
                'code' => 'apartment',
                'is_active' => true,
            ]);

            PropertyType::create([
                'name' => 'Commercial',
                'code' => 'commercial',
                'is_active' => true,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Occupancy Statuses
            |--------------------------------------------------------------------------
            */
            OccupancyStatus::create([
                'name' => 'Vacant',
                'code' => 'vacant',
                'is_active' => true,
            ]);

            $ownerOccupiedStatus = OccupancyStatus::create([
                'name' => 'Owner Occupied',
                'code' => 'owner_occupied',
                'is_active' => true,
            ]);

            OccupancyStatus::create([
                'name' => 'Tenant Occupied',
                'code' => 'tenant_occupied',
                'is_active' => true,
            ]);

            OccupancyStatus::create([
                'name' => 'Caretaker Occupied',
                'code' => 'caretaker_occupied',
                'is_active' => true,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Property Statuses
            |--------------------------------------------------------------------------
            */
            $activePropertyStatus = PropertyStatus::create([
                'name' => 'Active',
                'code' => 'active',
                'is_active' => true,
            ]);

            PropertyStatus::create([
                'name' => 'Inactive',
                'code' => 'inactive',
                'is_active' => true,
            ]);

            PropertyStatus::create([
                'name' => 'Under Construction',
                'code' => 'under_construction',
                'is_active' => true,
            ]);

            PropertyStatus::create([
                'name' => 'Disputed',
                'code' => 'disputed',
                'is_active' => true,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Cities
            |--------------------------------------------------------------------------
            */
            $taytay = City::create([
                'name' => 'Taytay',
                'province' => 'Rizal',
                'is_active' => true,
            ]);

            City::create([
                'name' => 'Cainta',
                'province' => 'Rizal',
                'is_active' => true,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Areas
            |--------------------------------------------------------------------------
            */
            $sanJuan = Area::create([
                'city_id' => $taytay->id,
                'name' => 'San Juan',
                'is_active' => true,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Subdivision Phases
            |--------------------------------------------------------------------------
            */
            $phase1 = null;

            for ($i = 1; $i <= 9; $i++) {
                $phase = SubdivisionPhase::create([
                    'name' => "Phase {$i}",
                    'code' => "P{$i}",
                    'description' => null,
                    'is_active' => true,
                ]);

                if ($i === 1) {
                    $phase1 = $phase;
                }
            }

            /*
            |--------------------------------------------------------------------------
            | Streets
            |--------------------------------------------------------------------------
            */
            Street::create([
                'subdivision_phase_id' => $phase1->id,
                'name' => 'Buenmar Ave',
                'is_active' => true,
            ]);

            Street::create([
                'subdivision_phase_id' => $phase1->id,
                'name' => 'Jasmine',
                'is_active' => true,
            ]);

            Street::create([
                'subdivision_phase_id' => $phase1->id,
                'name' => 'Crocus',
                'is_active' => true,
            ]);

            $hollyhock = Street::create([
                'subdivision_phase_id' => $phase1->id,
                'name' => 'Hollyhock',
                'is_active' => true,
            ]);

            $fir = Street::create([
                'subdivision_phase_id' => $phase1->id,
                'name' => 'Fir',
                'is_active' => true,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Properties
            |--------------------------------------------------------------------------
            */
            $property1 = Property::create([
                'city_id' => $taytay->id,
                'area_id' => $sanJuan->id,
                'subdivision_phase_id' => $phase1->id,
                'street_id' => $fir->id,

                'property_type_id' => $lotType->id,
                'occupancy_status_id' => $ownerOccupiedStatus->id,
                'property_status_id' => $activePropertyStatus->id,

                'property_code' => 'BLK3-LOT4B',
                'block_no' => '3',
                'lot_no' => '4B',
                'lot_area_sqm' => null,
                'house_no' => null,
                'address' => 'BLK 3 LOT 4B Fir Street, San Juan, Taytay, Rizal',
                'remarks' => null,
            ]);

            $property2 = Property::create([
                'city_id' => $taytay->id,
                'area_id' => $sanJuan->id,
                'subdivision_phase_id' => $phase1->id,
                'street_id' => $hollyhock->id,

                'property_type_id' => $lotType->id,
                'occupancy_status_id' => $ownerOccupiedStatus->id,
                'property_status_id' => $activePropertyStatus->id,

                'property_code' => 'BLK7-LOT18A',
                'block_no' => '7',
                'lot_no' => '18A',
                'lot_area_sqm' => null,
                'house_no' => null,
                'address' => 'BLK 7 LOT 18A Hollyhock Street, San Juan, Taytay, Rizal',
                'remarks' => null,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Users / Homeowners
            |--------------------------------------------------------------------------
            */
            $regie = User::create([
                'name' => 'Regie Ebalobor',
                'email' => 'regie@example.com',
                'password' => Hash::make('password'),
            ]);

            $richard = User::create([
                'name' => 'Richard Guzman',
                'email' => 'richard@example.com',
                'password' => Hash::make('password'),
            ]);

            /*
            |--------------------------------------------------------------------------
            | Homeowner Profiles
            |--------------------------------------------------------------------------
            */
            DB::table('homeowner_profiles')->insert([
                [
                    'user_id' => $regie->id,
                    'homeowner_code' => 'HO-0000001',
                    'contact_number' => '09171234567',
                    'alternate_contact_number' => null,
                    'billing_address' => 'BLK 3 LOT 4B Fir Street, San Juan, Taytay, Rizal',
                    'permanent_address' => 'BLK 3 LOT 4B Fir Street, San Juan, Taytay, Rizal',
                    'emergency_contact_name' => null,
                    'emergency_contact_number' => null,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'user_id' => $richard->id,
                    'homeowner_code' => 'HO-0000002',
                    'contact_number' => '09179876543',
                    'alternate_contact_number' => null,
                    'billing_address' => 'BLK 7 LOT 18A Hollyhock Street, San Juan, Taytay, Rizal',
                    'permanent_address' => 'BLK 7 LOT 18A Hollyhock Street, San Juan, Taytay, Rizal',
                    'emergency_contact_name' => null,
                    'emergency_contact_number' => null,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);

            /*
            |--------------------------------------------------------------------------
            | Property Ownerships
            |--------------------------------------------------------------------------
            */
            DB::table('property_ownerships')->insert([
                [
                    'property_id' => $property1->id,
                    'owner_user_id' => $regie->id,
                    'start_date' => now()->toDateString(),
                    'end_date' => null,
                    'is_current' => true,
                    'ownership_type' => 'owner',
                    'remarks' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'property_id' => $property2->id,
                    'owner_user_id' => $richard->id,
                    'start_date' => now()->toDateString(),
                    'end_date' => null,
                    'is_current' => true,
                    'ownership_type' => 'owner',
                    'remarks' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);

            DB::table('occupancy_types')->insert([
                ['name' => 'Owner'],
                ['name' => 'Tenant'],
                ['name' => 'Caretaker'],
                ['name' => 'Relative'],
            ]);

            /*
            |--------------------------------------------------------------------------
            | Property Occupancies
            |--------------------------------------------------------------------------
            */
            DB::table('property_occupancies')->insert([
                [
                    'property_id' => $property1->id,
                    'occupant_user_id' => $regie->id,
                    'occupant_name' => 'Regie Ebalobor',
                    'contact_number' => '09171234567',
                    'occupancy_type_id' => 1,
                    'move_in_date' => now()->toDateString(),
                    'move_out_date' => null,
                    'is_current' => true,
                    'remarks' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'property_id' => $property2->id,
                    'occupant_user_id' => $richard->id,
                    'occupant_name' => 'Richard Guzman',
                    'contact_number' => '09179876543',
                    'occupancy_type_id' => 1,
                    'move_in_date' => now()->toDateString(),
                    'move_out_date' => null,
                    'is_current' => true,
                    'remarks' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        });
    }
}
