<?php

namespace Modules\Base\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Products\Models\Products;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->month;
        $year  = $request->year ?? now()->year;

        if ($month && ($month > 12 || $month < 1)) {
            toastr()->error("Tháng phải lớn hơn 0 và nhỏ hơn hoặc bằng 12");
            return redirect()->back();
        }
        if ($year > now()->year || $year < 1) {
            toastr()->error("Năm phải lớn hơn 0 và nhỏ hơn hoặc bằng năm hiện tại");
            return redirect()->back();
        }
        $isYearly = empty($month);
        $date     = $isYearly
            ? now()->setDate($year, 1, 1)
            : create_date_by_month_year($year, $month);

        $viewData              = $this->__getDataTab($date,$isYearly);
        $viewData["dataChart"] = $this->__getDataChart($date, $isYearly);

        $viewData["topSellProducts"] = Products::with("category")
            ->orderBy("number_sell", "desc")
            ->get();

        $viewData["topLessSellProducts"] = Products::with("category")
            ->orderBy("number_sell")
            ->get();

        $viewData["query"] = $request->query();

        return view('base::dash_board')->with($viewData);
    }

    private function __getDataTab($date, $isYearly = false)
    {
        if ($isYearly) {
            $year = $date->year;

            $userCreateInDay = $this->__queryGetTab("users", $date, $isYearly);
            $blogCreateInDay = $this->__queryGetTab("blogs", $date, $isYearly);

            $orderTotalInDay = DB::table("orders")
                ->where("status", 2)
                ->whereYear('created_at', $year)
                ->sum("total");

            return [
                "userCreateInDay" => $userCreateInDay,
                "blogCreateInDay" => $blogCreateInDay,
                "orderTotalInDay" => $orderTotalInDay,
            ];
        } else {
            $userCreateInDay = $this->__queryGetTab("users", $date);
            $blogCreateInDay = $this->__queryGetTab("blogs", $date);

            $startDate = $date->startOfMonth()->toDateTimeString();
            $endDate = $date->endOfMonth()->toDateTimeString();

            $orderTotalInDay = DB::table("orders")
                ->where("status", 2)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->sum("total");

            return [
                "userCreateInDay" => $userCreateInDay,
                "blogCreateInDay" => $blogCreateInDay,
                "orderTotalInDay" => $orderTotalInDay,
            ];
        }
    }


    private function __queryGetTab($table, $date, $active = false)
    {
        $data      = DB::table($table);
        $startDate = $date->startOfMonth()->toDateTimeString();
        $endDate   = $date->endOfMonth()->toDateTimeString();

        if ($active) {
            $data = $data->where("status", 1);
        }
        return $data
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();
    }

    private function __getDataChart($date, $isYearly = false)
    {
        if ($isYearly) {
            $yearCurrent = $date->year;
            $months = range(1, 12);

            $dataChartLineAccount = DB::table("users")
                ->selectRaw('MONTH(created_at) as month, COUNT(id) as count')
                ->whereYear('created_at', $yearCurrent)
                ->groupBy('month')
                ->get()
                ->pluck('count', 'month')
                ->toArray();

            $dataChartLineOrder = DB::table("orders")
                ->selectRaw('MONTH(created_at) as month, SUM(total) as total')
                ->whereYear('created_at', $yearCurrent)
                ->groupBy('month')
                ->get()
                ->pluck('total', 'month')
                ->toArray();

            // Bổ sung giá trị mặc định cho các tháng không có dữ liệu
            foreach ($months as $month) {
                $dataChartLineAccount[$month] = $dataChartLineAccount[$month] ?? 0;
                $dataChartLineOrder[$month] = $dataChartLineOrder[$month] ?? 0;
            }

            // Đảm bảo đúng thứ tự tháng
            ksort($dataChartLineAccount);
            ksort($dataChartLineOrder);

            return [
                "dataChartLineAccount" => $dataChartLineAccount,
                "dataChartLineOrder" => $dataChartLineOrder,
                "yearCurrent"          => $yearCurrent,
                "monthCurrent"         => null,
            ];
        } else {
            $startDate = $date->startOfMonth()->toDateTimeString();
            $endDate = $date->endOfMonth()->toDateTimeString();
            $monthCurrent = $date->month;
            $yearCurrent = $date->year;

            $days = range(1, cal_days_in_month(CAL_GREGORIAN, $monthCurrent, $yearCurrent));

            $dataChartLineAccount = DB::table("users")
                ->selectRaw('DAY(created_at) as date, COUNT(id) as count')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('date')
                ->get()
                ->pluck('count', 'date')
                ->toArray();

            $dataChartLineOrder = DB::table("orders")
                ->selectRaw('DAY(created_at) as date, SUM(total) as total')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('date')
                ->get()
                ->pluck('total', 'date')
                ->toArray();

            $dataChartLineAccount = $this->__processDataChart($dataChartLineAccount, $days);
            $dataChartLineOrder = $this->__processDataChart($dataChartLineOrder, $days);

            return [
                "dataChartLineAccount" => $dataChartLineAccount,
                "dataChartLineOrder" => $dataChartLineOrder,
                "yearCurrent"          => $yearCurrent,
                "monthCurrent"         => $monthCurrent,
            ];
        }
    }


    private function __processDataChart($data, $keys)
    {
        foreach ($keys as $key) {
            if (!array_key_exists($key, $data)) {
                $data[$key] = 0;
            }
        }

        ksort($data);

        return $data;
    }

    private function __getTopExam()
    {
        $topExams = Exams::with("user")
            ->where("status", 1)
            ->orderBy("attempts", "desc")
            ->limit(10)
            ->get();

        return $topExams;
    }

    private function __getTopSchool()
    {
        $topSchools = Exams::with("school")
            ->selectRaw("sum(attempts) as attempts, school_id")
            ->where("school_id", "!=", 0)
            ->where("attempts", "!=", 0)
            ->groupBy("school_id")->orderBy("attempts", "desc")
            ->limit(10)
            ->get();

        return $topSchools;
    }
}

