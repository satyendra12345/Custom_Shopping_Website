<?php
namespace app\modules\statistics\models;

use Yii;
use yii\helpers\Url;

class Visitor extends \app\modules\statistics\models\base\BaseVisitor
{

    public static function add($data)
    {
        $limit = (YII_ENV == "dev") ? 5000 : 50000;
        if (Visitor::find()->count() > $limit) {
            Visitor::truncate();
        }
        $visitor = new Visitor();
        $visitor->group_date = (new \DateTime())->format('Ymd');
        $visitor->ip = $_SERVER['REMOTE_ADDR'];
        $visitor->location = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
        $visitor->browser = $data['browser'];
        $visitor->browser_version = $data['browser_version'];
        $visitor->device = $data['device'];
        $visitor->device_model = $data['device_model'];
        $visitor->os = $data['os'];
        $visitor->os_version = $data['os_version'];
        $visitor->referer = isset($data['referrer']) ? $data['referrer'] : null;
        $visitor->save();
    }

    public static function isValid()
    {
        $currentDate = new \DateTime();
        return Visitor::find()->where([
            '>=',
            'visit_date',
            $currentDate->modify('-1 hours')
                ->format('Y-m-d H:i:s')
        ])
            ->andWhere([
            'ip' => $_SERVER['REMOTE_ADDR']
        ])
            ->exists();
    }

    public function delete()
    {
        $currentDate = new \DateTime();
        Visitor::deleteAll([
            '<',
            'visit_date',
            $currentDate->modify('-30 day')->format('Y-m-d H:i:s')
        ]);
    }

    public function visit_period()
    {
        $v1 = Visitor::find()->where("TIME(visit_date) BETWEEN '00:00:00' AND '06:59:59'")->count();
        $v2 = Visitor::find()->where("TIME(visit_date) BETWEEN '07:00:00' AND '12:59:59'")->count();
        $v3 = Visitor::find()->where("TIME(visit_date) BETWEEN '13:00:00' AND '18:59:59'")->count();
        $v4 = Visitor::find()->where("TIME(visit_date) BETWEEN '19:00:00' AND '24:59:59'")->count();
        return "[{$v1},{$v2},{$v3},{$v4}]";
    }

    public function pie_chart()
    {
        $google = Visitor::find()->where([
            'like',
            'referer',
            'google.com'
        ])->count();
        $yahoo = Visitor::find()->where([
            'like',
            'referer',
            'yahoo.com'
        ])->count();
        $bing = Visitor::find()->where([
            'like',
            'referer',
            'bing.com'
        ])->count();
        $baidu = Visitor::find()->where([
            'like',
            'referer',
            'baidu.com'
        ])->count();
        $aol = Visitor::find()->where([
            'like',
            'referer',
            'aol.com'
        ])->count();
        $asc = Visitor::find()->where([
            'like',
            'referer',
            'ask.com'
        ])->count();
        return "[{$google},{$yahoo},{$bing},{$baidu},{$aol},{$asc}]";
    }

    public function lastVisitors()
    {
        return Visitor::find()->orderBy([
            'id' => SORT_DESC
        ])
            ->limit(200)
            ->asArray()
            ->all();
    }

    public function chart()
    {
        $currentDate = new \DateTime();
        $visitor = new Yii\db\Query();
        $result = $visitor->select('visit_date,group_date,COUNT(id) as `visit`,COUNT(DISTINCT ip) AS `visitor`')
            ->from($this->tableName())
            ->where([
            '>=',
            'visit_date',
            $currentDate->modify('-30 day')
                ->format('Y-m-d H:i:s')
        ])
            ->groupBy('group_date')
            ->all();

        $labels = $visit_data = $visitor_data = [];
        $max_visit = 0;
        foreach ((array) $result as $r) {
            $labels[] = "'" . $r['visit_date'] . "'";
            $visit_data[] = "'" . $r['visit'] . "'";
            $visitor_data[] = "'" . $r['visitor'] . "'";

            if ($r['visit'] > $max_visit) {
                $max_visit = $r['visit'];
            }
        }

        $labels = '[' . implode(',', $labels) . ']';
        $visit_data = '[' . implode(',', $visit_data) . ']';
        $visitor_data = '[' . implode(',', $visitor_data) . ']';

        $today_visitors = $today_visit = 0;
        $result_count = count($result) - 1;
        if (! empty($result[$result_count])) {
            $today_visitors = $result[$result_count]['visitor'];
            $today_visit = $result[$result_count]['visit'];
        }

        $yesterday_visitors = $yesterday_visit = 0;
        if (! empty($result[$result_count - 1])) {
            $yesterday_visitors = $result[$result_count - 1]['visitor'];
            $yesterday_visit = $result[$result_count - 1]['visit'];
        }

        $chart = [
            'labels' => $labels,
            'max_visit' => $max_visit,
            'visit' => [
                'title' => Yii::t('app', 'Visit'),
                'data' => $visit_data
            ],
            'visitor' => [
                'title' => Yii::t('app', 'Visitor'),
                'data' => $visitor_data
            ],
            'today_visitors' => (int) $today_visitors,
            'today_visit' => (int) $today_visit,
            'yesterday_visitors' => (int) $yesterday_visitors,
            'yesterday_visit' => (int) $yesterday_visit
        ];
        return $chart;
    }

    /**
     * get a link address(url) and shorten it for use title
     *
     * @param
     *            $linkAddress
     * @return string
     */
    public function getTitle($url, $linkAddress)
    {
        $re = '/\/\d+\/(.*).html/m';
        preg_match($re, $linkAddress, $matches);
        if (! empty($matches)) {
            $title = str_replace('-', ' ', urldecode($matches[1]));
        } else {
            $title = str_replace($url, null, $linkAddress);
            $title = preg_replace([
                '/^post\/view\/\d+\//',
                '/.html$/',
                '/site\/index.*%5B/',
                '/about\/index$/',
                '/contact\/index$/',
                '/^\/|\/$/'
            ], null, $title);
            if ($title == '') {
                $title = 'site/index';
            }
            $title = urldecode($title);
            $title = (mb_strlen($title) > 20) ? mb_substr($title, 0, 19, 'utf-8') . '...' : $title;
        }
        return $title;
    }

    public static function counter()
    {
       
        $url = Url::toRoute([
            "/statistics/visitor/add"
        ]);
        $script = '
        <script src="//cdn.jsdelivr.net/npm/ua-parser-js@0.7.20/src/ua-parser.min.js"></script>
        <script>
        var parser = new UAParser();
        var result = parser.getResult();
        var userInfo = {
            browser: result.browser.name
        }
        var params = "browser=" + result.browser.name + "&";
        params += "browser_version=" + parseInt(result.browser.version) + "&";
        params += "device=" + result.device.name + "&";
        params += "device_model=" + result.device.model + "&";
        params += "os=" + result.os.name + "&";
        params += "os_version=" + result.os.version + "&";
        params += "referrer=" + document.referrer + "&";
        params += "_csrf=" + yii.getCsrfToken();
        var http = new XMLHttpRequest();
        var url = " ' . $url . '";
        http.open("POST", url, true);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send(params);
        </script>
        ';
        return $script;
    }
}
