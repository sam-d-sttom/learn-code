<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class ChapterServices
{
    /**
     * Checks if a certian user has access to a chapter.
     */
    public function hasAccess(float $coins_needed, int $course_id, int $chapter_number, int $user_id)
    {
        $hasAccess = false;
        if ($coins_needed < 1) {
            $hasAccess = true;
        } else {
            $result = DB::select("SELECT * FROM users_chapters WHERE course_id = '$course_id' AND chapter_number = '$chapter_number' AND user_id = '$user_id'");

            if (!empty($result)) {
                $hasAccess = true;
            }
        }

        return $hasAccess;
    }
}
