<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body class="container">
    <?php
        
        if($_FILES){
            $targetDir="uploads";
            
            $targetFile = $targetDir.basename($_FILES['uploadedName']['name']);
            $fileType =strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            $uploadSuccess = true;
            if($_FILES['uploadedName']['error']!=0){
                echo "Chyba serveru při uploadu ";
                $uploadSuccess = false;
            }
            else if(file_exists($targetFile)){
                echo "Soubor již existuje ";
                $uploadSuccess = false;
            }
            else if($_FILES['uploadedName']['size']>(80000)){
                echo "soubor je moc velký ";
                $uploadSuccess=false;
            }
            /*elseif($fileType !== "jpg" || $fileType !== "png"){
                echo "špatný typ souboru ";
                $uploadSuccess=false;
            }*/
            if(!$uploadSuccess){    
                echo "došlo k chybě uploadu ";
            }
            else{
                if(move_uploaded_file($_FILES['uploadedName']['tmp_name'],$targetFile)){
                    echo"Soubor ".basename($_FILES['uploadedName']['name'])." byl uložen";
                }else{
                    echo"došlo k chybě uploadu";
                }
            }
        }
    ?>

    <div class="mb-3">
    <form method="post" action="" enctype="multipart/form-data">
    Select image to upload:
    <input class="form-control" type="file" name="uploadedName" accept="/image*,/video*,/audio*"/>
    <input class="btn btn-primary" type="submit" value="nahrát" name="submit">
    </div></form>
    <div>
        <?php 
          if($uploadSuccess){
            if($fileType === "jgp" || $fileType === "png"){
                echo '<img src="'.$targetFile.'">';
            }
            else{
                echo '<video width="320" height="240" controls>
            <source src="'.$targetFile.'" type="video/mp4">
          Your browser does not support the video tag.
          </video>';
            }
            
          
          }
        ?>
    </div>
    
</body>
</html>
