
<?php 
  //if ( !isset( $_POST ) || empty( $_POST ) )
  if(isset($_POST['email'])){



      $filter_rules = [
          'whats' => FILTER_SANITIZE_STRING,
          'email' => FILTER_VALIDATE_EMAIL,
          //'ip' => FILTER_VALIDATE_IP,
          //'website' => FILTER_VALIDATE_URL,
      ];

      $validation = [
          'whats'=>[
              'is_null'=>'name is empty',
              'is_false'=>'name is wrong value',
          ],
          'email'=>[
              'is_null'=>'email is empty',
              'is_false'=>'email is wrong value',

          ]
          /*
          ,
          'ip'=>[
              'is_null'=>'ip is empty',
              'is_false'=>'ip is wrong value',
          ],
          'website'=>[
              'is_null'=>'website is empty',
              'is_false'=>'website is wrong value',
          ],
          */
      ];

      /** MOTOR OU CORE DA APLICAÇÃO */

      $data = filter_input_array(INPUT_POST, $filter_rules);

      foreach ($data as $field=>$value) {
          if (empty($validation[$field])) {
              continue;
          }

          if ($value === null or $value == '') {
              echo $validation[$field]['is_null'];
          } elseif ($value === false) {
              echo $validation[$field]['is_false'];
          } elseif (isset($validation[$field]['other']) and $validation[$field]['other'] !== null) {
              echo $validation[$field]['other']($value);
          }

          echo '<br>';
      }

      echo '<br>';

      var_dump($data);

      echo '<a href="index.html">voltar</a>';


	  
        $whats =$_POST["whats"];
        $from =$_POST["email"];
        //$comment=$_POST["comment"];

        // Email Receiver Address
        $receiver="cicero.ice@gmail.com";
        $subject="Landing Page";

        $message = "
        <html>
        <head>
        <title>HTML email</title>
        </head>
        <body>
        <table width='50%' border='0' align='center' cellpadding='0' cellspacing='0'>
        <tr>
        <td colspan='2' align='center' valign='top'><img style=' margin-top: 15px; ' src='http://www.yourdomain.com/images/logo-mail.png' ></td>
        </tr>
        <tr>
        <td width='50%' align='right'>&nbsp;</td>
        <td align='left'>&nbsp;</td>
        </tr>
        
        <!--<tr>
        <td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Whatsapp:</td>
        <td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$whats."</td>
        </tr>-->
    
        <tr>
        <td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Email:</td>
        <td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$from."</td>
        </tr>
    
        </table>
        </body>
        </html>
        ";
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // More headers
        $headers .= 'From: <'.$from.'>' . "\r\n";




       if(mail($receiver,$subject,$message,$headers)){
           //Success Message
         //echo "Solicitação enviada com sucesso!";
         echo "<script>$(document).ready(function(){
                    $(\"input#email\").val(\"\");
                    $('#modal').modal('show');

                });</script>";
       }

       else
       {
         //Fail Message

          echo "The message could not been sent!";
       }

   }

  else {
      //Fail Message

      echo "Erro! Verifique se o email foi preenchido corretamente!";
  }
?>
