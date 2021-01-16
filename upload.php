<?php
	//panggil koneksi database
	include "database.php";

	//pengujian jika tombol upload diklik
	if(isset($_POST['upload_btn']))
	{
		//ekstensi file yang boleh di upload
		$allowed_ext = array('png', 'jpg', 'gif');
		$name = $_FILES['file']['name']; // untuk mendapatkan nama file yang diupload
		$file_basename = substr($name, 0, strripos($name, '.')); //basename filenya
		$file_ext = substr($name, strripos($name, '.')); // ekstensi filenya

		$x = explode(".", $name);
		$ext = strtolower(end($x));
		$size = $_FILES['file']['size']; //untuk mendapatkan ukuran file yang akan di upload
		$file_tmp = $_FILES['file']['tmp_name']; //untuk mendapatkan temporary file yang akan di upload (tmp)
		$name = $_FILES['file']['name'];
		$newfilename = md5($file_basename) . $file_ext;
		$check = exif_imagetype($file_tmp);
		// uji jika file yang diupload double extension atau tidak
		if(count($x) !== 2){
		    
		  if($x[1] == "php"){
		      
		    echo "<script>alert('HoHoHo Jangan Diserang Bang'); document.location='index.php'</script>";
		  }
		  else{
		      
		    echo "<script>alert('Gagal Bang'); document.location='index.php'</script>";
		  }
		  
		}else{
		  
		    if($check == IMAGETYPE_JPEG || $check == IMAGETYPE_PNG){
                //uji jika ekstensi file yang diupload sesuai
			    if(in_array($ext, $allowed_ext) === true){
				    //boleh upload file
			    	//uji jika ukuran file dibawah 1mb
			    	if($size < 1044070){
					//jika ukuran sesuai
					//PINDAHKAN FILE YANG DI UPLOAD KE FOLDER FILE aplikasi
				    	move_uploaded_file($file_tmp, 'fileupload/'.$newfilename);

				    	//simpan data ke dalam database
				    	$upload = mysqli_query($db, "INSERT INTO 
													  upload (file_name)
													  VALUES ('$name')");
				    	if($upload){
					    	echo "<script>alert('Berhasil Bang'); document.location='index.php'</script>";
						
    					}else{
    						echo "<script>alert('Gagal Bang'); document.location='index.php'</script>";
    						
    					}

    				}else{
    					//ukuran tidak sesuai
    					echo "<script>alert('Filenya besar kali Bang'); document.location='index.php'</script>";
    				}
				
    			}else{
    				//ektensi file yang di upload tidak sesuai
    				echo "<script>alert('Maaf Bang ekstensinya tidak cocok'); document.location='index.php'</script>";
    			}		        
		        
		    }else{
		        echo "<script>alert('HoHoHo Bukan Gambar Ya'); document.location='index.php'</script>";
		    }

			

		}
	}


?>