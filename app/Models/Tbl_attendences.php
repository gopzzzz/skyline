<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_attendences extends Model
{
    use HasFactory;
    public function staff()
    {
        return $this->belongsTo(Tbl_staffs::class, 'staff_id');
    }

    public function getStatusNameAttribute()
    {
        // Define a mapping for status names based on the status ID
        $statusMapping = [
            0 => 'Absent',
            1 => 'Full Day',
            2 => 'Half Day',
            // Add more as needed
        ];

        // Return the status name based on the mapping
        return $statusMapping[$this->status];
    }

    public function getDayTypeNameAttribute()
    {
        // Define a mapping for day type names based on the day type ID
        $dayTypeMapping = [
            0 => '',
            1 => 'Morning',
            2 => 'Afternoon',
            // Add more as needed
        ];


          // Return the day type name based on the mapping
          return $dayTypeMapping[$this->day_type];
    }
        }
