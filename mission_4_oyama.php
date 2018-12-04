<?php
//MySQLに接続//
$dsn='mysql:dbname=データベース名;host=localhost';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

//テーブル作成//
$sql="CREATE TABLE IF NOT EXISTS tb_mission_4_oyama"  //テーブルがなかったら作成
."("
."id INT not null auto_increment primary key,"
."name char(32)," //名前
."comment TEXT,"//コメント
."date DATETIME,"//投稿日時
."pass TEXT" //パスワード
.");";
$stmt=$pdo->query($sql);//queryメソッドで実行

//テーブル作成できたか確認//
$sql = 'SHOW TABLES';
$result = $pdo -> query($sql);
foreach($result as $row){
	echo $row[0];
	echo '<br>';
	}	
	echo"<hr>";
?>

<!DOCTYPE html>
<html lang 'ja'>
 <head>
  <meta charset = "UTF-8">
 </head>
  <body>

<?php
//名前・コメント・パスワードを送信//
$name1=$_POST['name'];
$comment1=$_POST['comment'];
$pass1=$_POST['pass'];
if(isset($_POST['button']) and empty($_POST['editnumber2'])){   //送信ボタン押されhidden空の時
  if(strlen($_POST['comment'])>0 and strlen($_POST['name'])>0 and strlen($_POST['pass'])>0){ //各欄が空白でない時
  //MySQLに接続//
$dsn='mysql:dbname=データベース名;host=localhost';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn,$user,$password);

//テーブルに名前・コメント・パスワードを挿入//
 $sql=$pdo->prepare("INSERT INTO tb_mission_4_oyama(name, comment,date,pass)VALUES (:name,:comment,:date,:pass)");               
  $sql->bindParam(':name', $name, PDO::PARAM_STR);	
  $sql->bindParam(':comment', $comment, PDO::PARAM_STR);	
  $sql->bindParam(':date', $date, PDO::PARAM_STR);	
  $sql->bindParam(':pass', $pass, PDO::PARAM_STR);		
  $name=$_POST['name'];	//name変数にフォームで送られた名前入れる
  $comment=$_POST['comment'];	//comment変数に送られたコメント入れる
  $date=date("Y/m/d H:i:s");	//date関数で取得した現在日時＝投稿日時
  $pass=$_POST['pass'];
  $sql-> execute();	//クエリの実行
  }//if(strlen($comment)>0 and strlen($name)>0 and strlen($pass)>0)
}//if(isset($_POST['button']) and empty($_POST['editnumber2']))

//削除//
if(isset($_POST['deletebutton'])){   //削除ボタン押されたとき
 if(!empty($_POST['delnumber']) and !empty($_POST['pass_del'])){  //番号とパスが送信された場合 
    $deleteNo=$_POST['delnumber'];              //送信された番号(削除番号）
    $pass_del=$_POST['pass_del'];               //入力されたパスワード
//MySQLに接続//
$dsn='mysql:dbname=データベース名;host=localhost';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn,$user,$password);

//データ取り出し//
 $sql='SELECT*FROM tb_mission_4_oyama'; //selectで全てのデータを取り出す
    $results= $pdo->query($sql);
    foreach ($results as $row){  //ループ処理(1つずつ取り出し）
     if($row['id']== $deleteNo and $row['pass']==$pass_del){ //パスと投稿番号一致
     $id=$deleteNo;
     $sql="delete from tb_mission_4_oyama where id=$id"; //idが一致する投稿を削除
     $result=$pdo->query($sql);
     }// if($value_del[0]== $deleteNo and $pass_del==$value_del[4])
    }//foreach
 }// if(!empty($_POST['delnumber']) and !empty($_POST['pass_del']))
}//if(isset($_POST['deletebutton']))

//編集//
if(isset($_POST['editnumber'])){      //編集ボタン押されたとき
 if(!empty($_POST['editnumber']) and !empty($_POST['pass_edit'])){   //編集番号とパスが送信されたとき
   $editNo=$_POST['editnumber'];           //送信された値   
   $pass_edit=$_POST['pass_edit'];          //入力されたパスワード 
   
   //MySQLに接続//
$dsn='mysql:dbname=データベース名;host=localhost';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn,$user,$password);

//データ取り出し//
 $sql='SELECT*FROM tb_mission_4_oyama'; //selectで全てのデータを取得
    $results= $pdo->query($sql);
    foreach ($results as $row){  //ループ処理（1つずつ取り出し)
     if($row['id']==$editNo and $row['pass']==$pass_edit){     //投稿番号と編集番号,パス同士一致するとき
          $oldname=$row['name'];           //以前書き込まれた名前
          $oldcomment=$row['comment'];          //以前書き込まれたコメント
          $oldpass=$row['pass'];              //保存された以前のパスワード
        // echo $oldname;
        // echo $oldcomment;
      }//if($posNo==$editNo)
    }//foreach($file_edt as $line_edt)
  }//if(strlen($_POST['editnumber']>0))
}//if(isset($_POST['editbuntton']))

//編集上書き//
if(isset($_POST['button'])){   //送信ボタン押され時
 if(strlen($comment1)>0 and strlen($name1)>0 and !empty($_POST['editnumber2'])){ //各欄が空白でない時
       $editNo2=$_POST['editnumber2'];         //テキストボックスの値
       $newname=$_POST['name'];                //編集された名前
       $newcomment=$_POST['comment'];          //編集されたコメント
       $timestamp= time();                      //投稿日時
       $date= date("Y/m/d H:i:s",$timestamp);
       $pass_new=$_POST['pass'];                 //入力されたパスワード
       
       //MySQLに接続//
$dsn='mysql:dbname=データベース名;host=localhost';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn,$user,$password);

//データ取り出し//
 $sql='SELECT*FROM tb_mission_4_oyama'; //selectですべてのデータを取得
       $results= $pdo->query($sql);
         foreach ($results as $row){  //ループ処理(1つずつ取り出し)
             if($row['id']==$editNo2){             //テキストボックスの値と投稿番号が一致する時
                $id=$editNo2;
                $nm= $newname;
                $kome=$newcomment;
                $hidzuke= date("Y/m/d H:i:s");
                $pasu=$pass_new;
                $sql="update tb_mission_4_oyama set name='$nm', comment='$kome', date='$hidzuke', pass='$pasu' where id ='$id'";//上書き
                $results=$pdo->query($sql);
              }//if
          }//foreach
}//if(!empty($_POST['editnumber2']))
}//if(isset)
?>

<!--投稿フォーム-->
 <form method="post" action="mission_4_oyama.php">
 名前:<br/>
 <input type="text" name="name" placeholder="<?php if(isset($_POST['editnumber'])){ echo $oldname;} ?>"  /><br/>
 コメント:<br/>
 <input type="text" name="comment"  placeholder="<?php if(isset($_POST['editnumber'])){ echo $oldcomment;} ?>"/ ><br/>
パスワード:<br/>
  <input type="text" name="pass" value="<?php if(isset($_POST['editnumber'])){ echo $oldpass;} ?>"/><br/>
<!-- 編集したい番号を表示-->
 <input type="hidden" name="editnumber2" value="<?php if(isset($_POST['editnumber'])){ echo $editNo;} ?>"/><br/>
 <button type="submit" name="button" value="ボタン">送信</button>
 </form>

<!--削除フォーム-->
 <form method="post" action="mission_4_oyama.php">
 削除対象番号:<br/>
<input type="number" name="delnumber" value=""><br/>
パスワード:<br/>
 <input type="text" name="pass_del" value=""><br/>
<button type="submit" name="deletebutton">削除</button>
</form>

<!--編集フォーム-->
<form method="post" action="mission_4_oyama.php">
編集対象番号<br/>
<input type="number" name="editnumber" value=""><br/>
パスワード:<br/>
 <input type="text" name="pass_edit" value=""><br/>
<button type="submit" name="editbutton">編集</button>
</form>

<?php
//MySQLに接続//
$dsn='mysql:dbname=データベース名;host=localhost';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn,$user,$password);

//これまでやったことが反映されたかチェック//
$sql='SELECT*FROM tb_mission_4_oyama'; //selectですべてのデータ取得
$results= $pdo->query($sql);
foreach ($results as $row){ //1つずつ取り出し
 echo $row['id'].',';
 echo $row['name'].',';
 echo $row['comment'].',';
 echo $row['date'].'<br>'; 
}//foreach
?>

</body>
</html>



  