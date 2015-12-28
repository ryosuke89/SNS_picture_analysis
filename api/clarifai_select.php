<?php require_once 'api_dbaccesUtil.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
</head>
  <body>
    <table border=1>
      <tr>
        <th>画像認識の番号</th>
        <th>認識結果1</th>
        <th>認識結果2</th>
        <th>認識結果3</th>
        <th>認識結果4</th>
        <th>認識結果5</th>
        <th>認識結果6</th>
        <th>認識結果7</th>
        <th>認識結果8</th>
        <th>認識結果9</th>
        <th>認識結果10</th>
        <th>認識結果11</th>
        <th>認識結果12</th>
        <th>認識結果13</th>
        <th>認識結果14</th>
        <th>認識結果15</th>
        <th>認識結果16</th>
        <th>認識結果17</th>
        <th>認識結果18</th>
        <th>認識結果19</th>
        <th>認識結果20</th>
        <th>SNSの番号</th>
        <th>画像の番号</th>
      </tr>
      <?php
      //画像認識の結果を表示
      $result = select_recognition();

      foreach($result as $value){
          ?>
          <tr>
            <td><?php echo $value['recognitionID']; ?></td>
            <td><?php echo $value['result1']; ?></td>
            <td><?php echo $value['result2']; ?></td>
            <td><?php echo $value['result3']; ?></td>
            <td><?php echo $value['result4']; ?></td>
            <td><?php echo $value['result5']; ?></td>
            <td><?php echo $value['result6']; ?></td>
            <td><?php echo $value['result7']; ?></td>
            <td><?php echo $value['result8']; ?></td>
            <td><?php echo $value['result9']; ?></td>
            <td><?php echo $value['result10']; ?></td>
            <td><?php echo $value['result11']; ?></td>
            <td><?php echo $value['result12']; ?></td>
            <td><?php echo $value['result13']; ?></td>
            <td><?php echo $value['result14']; ?></td>
            <td><?php echo $value['result15']; ?></td>
            <td><?php echo $value['result16']; ?></td>
            <td><?php echo $value['result17']; ?></td>
            <td><?php echo $value['result18']; ?></td>
            <td><?php echo $value['result19']; ?></td>
            <td><?php echo $value['result20']; ?></td>
            <td><?php echo $value['snsID']; ?></td>
            <td><?php echo $value['photoID']; ?></td>
          </tr>
          <?php
      }
      ?>
    </table>
  </body>
</html>
