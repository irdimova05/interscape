<?php

namespace App\Services;

use App\Models\Ad;
use App\Models\ReportedAd;

class ReportedAdService
{
    public static function getReportedAds($callback = null)
    {
        $reportedAds = Ad::where('is_reported', true)->get();

        if ($callback) {
            $reportedAds = $callback($reportedAds);
        }

        return $reportedAds;
    }

    public static function reportAd($adId, $reason)
    {
        $ad = Ad::find($adId);

        $reportAd = new ReportedAd();
        $reportAd->ad_id = $ad->id;
        $reportAd->student_id = auth()->user()->student->id;
        $reportAd->reason = $reason;
        $reportAd->save();

        $ad->is_reported = true;
        $ad->save();
    }

    public static function releaseAd($ad)
    {
        $ad->is_reported = false;
        $ad->save();
    }
}
