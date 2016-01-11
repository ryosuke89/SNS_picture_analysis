<?php
require_once '../common/defineUtil.php';

//トップページへのリンクの関数
function return_top(){
    return "<a href='".ROOT_URL."'>トップページ</a>";
}

//SNS名からSNSの番号を返却する関数
function ex_sns($snsName){
    switch ($snsName){
        case "Twitter";
            return 1;
        case "Facebook";
            return 2;
        case "Google ";
            return 3;
        case "Instagram";
            return 4;
    }
}

//セッションの値を取得する関数
function contact_session($name){
    if(isset($_POST['mode']) && $_POST['mode'] == 'REINPUT'){
        if(isset($_SESSION[$name])){
            return $_SESSION[$name];
        }
    }
}

//POSTの値をセッションに格納する関数
function confirm_session($name){
    if(!empty($_POST[$name])){
        $_SESSION[$name] = $_POST[$name];
        return $_POST[$name];
    }else{
        $_SESSION[$name] = null;
        return null;
    }
}

//SNS全体またはSNSごとの割合の円グラフを表示する関数
function chart($get_sns, $result_category){
    ?>
    //円グラフパッケージとVisualization APIの読み込み
    google.load('visualization', '1.0', {'packages':['corechart']});

    //Visualization APIを呼び出したときに実行するコールバックの設定
    google.setOnLoadCallback(drawChart);

    //データテーブルの作成と挿入のコールバック。
    //円グラフを作成し、データを渡し、描画する
    function drawChart(){

        //データテーブルの作成
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'カテゴリー');
        data.addColumn('number', '割合');
        //円グラフにSNSの割合を表示する処理
        <?php
        foreach($result_category as $value_category){
            ?>
            data.addRows([
                ['<?php echo $value_category['categoryName']; ?>', <?php echo $value_category['categoryPercentage']; ?>]
            ]);
            <?php
        }
        ?>

        //チャートオプションの設定
        var options = {'title':'<?php if(empty($get_sns)){echo 'SNS全体';}elseif($get_sns == 'Google '){echo 'Google+';}else{echo $get_sns;} ?>の割合',
                        'width':600,
                        'height':400};

        //いくつかのオプションを渡してチャートを描画する
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
    <?php
}

//カテゴリーごとの割合の円グラフを表示する関数
function detail_chart($get_sns, $get_category, $result_kind){
    ?>
    //円グラフパッケージとVisualization APIの読み込み
    google.load('visualization', '1.0', {'packages':['corechart']});

    //Visualization APIを呼び出したときに実行するコールバックの設定
    google.setOnLoadCallback(drawChart);

    //データテーブルの作成と挿入のコールバック。
    //円グラフを作成し、データを渡し、描画する
    function drawChart(){

        //データテーブルの作成
        var data1 = new google.visualization.DataTable();
        data1.addColumn('string', 'Twitterでの種類');
        data1.addColumn('number', '割合');
        //円グラフに種類の割合を表示する処理
        <?php
        foreach($result_kind as $value_kind){
            ?>
            data1.addRows([
                ['<?php echo $value_kind['kindName']; ?>', <?php echo $value_kind['kindPercentage']; ?>]
            ]);
            <?php
        }
        ?>

        var data2 = new google.visualization.DataTable();
        data2.addColumn('string', 'Facebookでの種類');
        data2.addColumn('number', '割合');
        <?php
        foreach($result_kind as $value_kind){
            ?>
            data2.addRows([
                ['<?php echo $value_kind['kindName']; ?>', <?php echo $value_kind['kindPercentage']; ?>]
            ]);
            <?php
        }
        ?>

        var data3 = new google.visualization.DataTable();
        data3.addColumn('string', 'Google+での種類');
        data3.addColumn('number', '割合');
        <?php
        foreach($result_kind as $value_kind){
            ?>
            data3.addRows([
                ['<?php echo $value_kind['kindName']; ?>', <?php echo $value_kind['kindPercentage']; ?>]
            ]);
            <?php
        }
        ?>

        var data4 = new google.visualization.DataTable();
        data4.addColumn('string', 'Instagramでの種類');
        data4.addColumn('number', '割合');
        <?php
        foreach($result_kind as $value_kind){
            ?>
            data4.addRows([
                ['<?php echo $value_kind['kindName']; ?>', <?php echo $value_kind['kindPercentage']; ?>]
            ]);
            <?php
        }
        ?>

        //チャートオプションの設定
        var options1 = {'title':'<?php if(empty($get_sns)){echo 'Twitterでの' . $get_category; }else{echo $get_sns . 'での' . $get_category; } ?>の割合',
                        'width':600,
                        'height':400};

        var options2 = {'title':'<?php if(empty($get_sns)){echo 'Twitterでの' . $get_category; }else{echo $get_sns . 'での' . $get_category; } ?>の割合',
                        'width':600,
                        'height':400};

        var options3 = {'title':'<?php if(empty($get_sns)){echo 'Twitterでの' . $get_category; }else{echo $get_sns . 'での' . $get_category; } ?>の割合',
                        'width':600,
                        'height':400};

        var options4 = {'title':'<?php if(empty($get_sns)){echo 'Twitterでの' . $get_category; }else{echo $get_sns . 'での' . $get_category; } ?>の割合',
                        'width':600,
                        'height':400};

        //いくつかのオプションを渡してチャートを描画する
        var chart1 = new google.visualization.PieChart(document.getElementById('chart_div1'));
        chart1.draw(data1, options1);

        var chart2 = new google.visualization.PieChart(document.getElementById('chart_div2'));
        chart2.draw(data2, options2);

        var chart3 = new google.visualization.PieChart(document.getElementById('chart_div3'));
        chart3.draw(data3, options3);

        var chart4 = new google.visualization.PieChart(document.getElementById('chart_div4'));
        chart4.draw(data4, options4);
    }
    <?php
}
