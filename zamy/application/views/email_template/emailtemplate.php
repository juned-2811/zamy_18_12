<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title><?=isset($title)?$title:'HOPMeal POS' ?></title>
      <style type="text/css">
         body {
         margin-top: 0 !important;
         margin-bottom: 0 !important;
         padding-top: 0 !important;
         padding-bottom: 0 !important;
         width: 100% !important;
         -webkit-text-size-adjust: 100% !important;
         -ms-text-size-adjust: 100% !important;
         -webkit-font-smoothing: antialiased !important;
         color: #666;
           font-family: open sans;
         }
         img {
         border: 0 !important;
         outline: none !important;
         display:block !important;
         }
         table {
         border-collapse: collapse;
         mso-table-lspace: 0px;
         mso-table-rspace: 0px;
         }
         td {
         border-collapse: collapse;
         mso-line-height-rule: exactly;
         }
         a {
         border-collapse: collapse;
         mso-line-height-rule: exactly;
         }
         p {
         margin: 0px;
         padding: 0px;
         }
         span {
         border-collapse: collapse;
         mso-line-height-rule: exactly;
         }
         .itm-tbl th {
           color: #666;
           font-family: open sans;
           font-weight: bold;
           height: 50px;
           text-align: left;
         }
         .itm-img > img {
           height: 84px;
           width: 150px;
           padding: 10px 0;
         }
         .bb td, .bb th {
           border-bottom: 1px solid #666 !important;
          }
          .total-amt td {
           font-weight: bold;
           padding: 15px 0;
         }
         @media only screen and (min-width : 600px) and (max-width : 700px)
         {
         table[class=main_table]
         {
         width:600px !important;
         }
         table[class=wrapper]
         {
         width:100% !important;
         }
         td[class=font]{ font-size:15px !important; padding:0px 10px 0px 10px;}
         }
         @media only screen and (min-width : 481px) and (max-width : 600px)
         {
         table[class=main_table]
         {
         width:480px !important;
         }
         table[class=wrapper]
         {
         width:100% !important;
         }
         td[class=font]{ font-size:11px !important; padding:0px 10px 0px 10px;}
         .itm-img > img {
           height: 44px;
           width: 110px;
         }
         }
         
         @media only screen and (max-width : 480px)
         {
         table[class=main_table]
         {
         width:320px !important;
         }
         table[class=wrapper]
         {
         width:100% !important;
         }
         td[class=font]{ font-size:11px !important; padding:0px 10px 0px 10px;}
         .itm-img > img {
           height: 44px;
           width: 70px;
         }
         }

      </style>
   </head>
   <body  marginwidth="0" marginheight="0" style="margin-top: 0; margin-bottom: 0; padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;background-color:#999999;" offset="0" topmargin="0" leftmargin="0" bgcolor="#999999" >
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
            <td align="center">
               <table align="center" width="700" border="0" cellspacing="0" cellpadding="0" class="main_table">
                  <tr>
                     <td align="center">
                        <table align="center" width="700" border="0" cellspacing="0" cellpadding="0" class="wrapper">
                           <!--header section-->
                           <tr>
                              <td align="center">
                                 <table align="center" width="700" border="0" cellspacing="0" cellpadding="0" class="wrapper" bgcolor="#C9C9C9">
                                    <tr>
                                       <td height="30">&nbsp;</td>
                                    </tr>
                                    <tr>
                                       <td align="center">
                                          <table align="center" width="700" border="0" cellspacing="0" cellpadding="0" class="wrapper" >
                                             <tr>
                                                <td width="15"></td>
                                                <td align="center">
                                                   <table align="center" width="670" border="0" cellspacing="0" cellpadding="0" class="wrapper">
                                                      <tr>
                                                         <td>
                                                            <table align="center" width="158" border="0" cellspacing="0" cellpadding="0" class="wrapper">
                                                               <tr>
                                                                  <td align="left"><a href="<?php echo base_url(); ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/image/dark-logo.png" width="151" height="32" alt="Attune" /></a></td>
                                                               </tr>
                                                            </table>
                                                         </td>
                                                         
                                                      </tr>
                                                   </table>
                                                </td>
                                                <td width="15"></td>
                                             </tr>
                                          </table>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td height="30">&nbsp;</td>
                                    </tr>
                                 </table>
                              </td>
                           </tr>
                           <!--header section-->
                           <!--content section-->
						   
                           <tr>
                              <td align="center">
                                 <table width="700" border="0" cellspacing="0" cellpadding="0" class="wrapper" bgcolor="#ffffff">
                                    <tr>
                                       <td width="15"></td>
                                       <td align="center">
                                          <table align="center" width="670" border="0" cellspacing="0" cellpadding="0" class="wrapper" align="left">
                                            
                                             <tr>
                                                <td height="26">&nbsp;</td>
                                             </tr>
                                             <tr>
                                                <td align="center">
                                                   
                                                 <?php echo '<p>Hello ,'.$to.'</p>'
					. '<p>Your email and password is following :</p>'
					. '<p>Email:<strong>' . $email . '</strong></p>'
					. '<p>Your new password : <strong>' . $passwordplain . '</strong></p>'
					. '<p>Now you can login with this email and password</p><p><a href="'.base_url("users/login").'" target="_blank">Click here</a> to Login</p>'; ?> 
                                                   
                                                </td>
                                             </tr>
                                             <tr>
                                                <td height="17" style="font-size:1px; line-height:1px;">&nbsp;</td>
                                             </tr>
                                            
                                             
                                          </table>
                                       </td>
                                       <td width="15"></td>
                                    </tr>
                                 </table>
                              </td>
                           </tr>
                           <!--content section-->
                           <!--footer section-->
                           <tr>
                              <td bgcolor="#CCCCCC">
                                 <table align="center" width="700" border="0" cellspacing="0" cellpadding="0" class="wrapper">
                                    <tr>
                                       <td width="15"></td>
                                       <td align="center">
                                          <table align="center" width="670" border="0" cellspacing="0" cellpadding="0" class="wrapper">
                                             <tr>
                                                <td height="12" style="font-size:1px; line-height:1px;">&nbsp;</td>
                                             </tr>
                                             <tr>
                                                <td align="left" style=" font-size:25px; font-weight:bold; text-decoration:none;"><a style="text-decoration:none;  color:#1580AE;" href="<?php echo base_url(); ?>">Zamy</a></td>
                                             </tr>
                                             <tr>
                                                <td height="8" style="font-size:1px; line-height:1px;">&nbsp;</td>
                                             </tr>
                                             <tr>
                                                <td class="font" align="left" style=" font-size:15px; line-height:22px;  text-decoration:none;">  <br/>
                                                   Ahmedabad<br/>
                                                   <a style=" text-decoration:none; color:#000000;" href="mailto:info@givetou.com">contact@hopmeal.com</a> | M: +919033550022
                                                </td>
                                             </tr>
                                             <tr>
                                                <td height="18" style="font-size:1px; line-height:1px;">&nbsp;</td>
                                             </tr>
                                          </table>
                                       </td>
                                       <td width="15"></td>
                                    </tr>
                                 </table>
                              </td>
                           </tr>
                           <!--footer section-->
                           <tr>
                              <td></td>
                           </tr>
                        </table>
                     </td>
                  </tr>
                  <tr> 
                     <td align="center" style="font-size:13px; line-height:16px; color:#666666; padding:10px 0px;">&copy; <a href="<?php echo base_url(); ?>"><?=isset($title)?$title:'HOPMeal POS' ?></a>
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
      </table>
      </td>
      </tr>
      </table>
   </body>
</html>

