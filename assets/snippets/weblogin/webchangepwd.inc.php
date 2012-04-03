<?php
# WebChangePwd 1.0
# Created By Raymond Irving April, 2005
#::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

defined('IN_PARSER_MODE') or die();

# load tpl
if(is_numeric($tpl)) $tpl = ($doc=$modx->getDocuments($tpl)) ? $doc['content']:"Document '$tpl' not found.";
else if($tpl) $tpl = ($chunk=$modx->getChunk($tpl)) ? $chunk:"Chunk '$tpl' not found.";
if(!$tpl) $tpl = getWebChangePwdtpl();

// extract declarations
$declare = webLoginExtractDeclarations($tpl);
$tpls = explode((isset($declare["separator"]) ? $declare["separator"]:"<!--tpl_separator-->"),$tpl);

if(!$isPostBack && isset($_SESSION['webValidated'])){
    // display password screen
    $tpl = $tpls[0];
    $tpl = str_replace("[+action+]",$modx->makeUrl($modx->documentIdentifier),$tpl);
    $tpl.="<script type='text/javascript'>
        if (document.changepwdfrm) document.changepwdfrm.oldpassword.focus();
        </script>";
    $output .= $tpl;
} 
else if ($isPostBack && isset($_SESSION['webValidated'])){
    $oldpassword = $_POST['oldpassword'];
    $genpassword = $_POST['newpassword'];
    $passwordgenmethod = $_POST['passwordgenmethod'];
    $passwordnotifymethod = $_POST['passwordnotifymethod'];
    $specifiedpassword = $_POST['specifiedpassword'];
    
    $uid = $modx->getLoginUserID();
    $type = $modx->getLoginUserType();

    // load template
    $tpl = $tpls[0];
    $tpl = str_replace("[+action+]",$modx->makeUrl($modx->documentIdentifier),$tpl);
    $tpl.="<script type='text/javascript'>if (document.changepwdfrm) document.changepwdfrm.oldpassword.focus();</script>";

    // get user record
    if($type=='manager') $ds = $modx->getUserInfo($uid);
    else $ds = $modx->getWebUserInfo($uid);

    // verify password
    if($ds['password']==md5($oldpassword)) {

        // verify password
        if ($passwordgenmethod=="spec" && $_POST['specifiedpassword']!=$_POST['confirmpassword']) {
            $output = webLoginAlert($langTXT[31],$alerttpl).$tpl;
            return;
        }

        // generate a new password for this user
        if($specifiedpassword!="" && $passwordgenmethod=="spec") {
            if(strlen($specifiedpassword) < 6 ) {
                $output = webLoginAlert($langTXT[32],$alerttpl).$tpl;
                return;
            } else {
                $newpassword = $specifiedpassword;
            }            
        } elseif($specifiedpassword=="" && $passwordgenmethod=="spec") {
            $output = webLoginAlert($langTXT[33],$alerttpl).$tpl;
            return;        
        } elseif($passwordgenmethod=='g') {
            $newpassword = webLoginGeneratePassword(8);        
        } else {
            $output = webLoginAlert($langTXT[34],$alerttpl).$tpl;
            return;
        }

        // handle notification
        if($passwordnotifymethod=='e') {
            $rt = webLoginSendNewPassword($ds["email"],$ds["username"],$newpassword,$ds["fullname"]);
            if($rt!==true) { // an error occured
                $output = $rt.$tpl;
                return;
            }
            else {
                $newpassmsg = $langTXT[35];
            }
        }
        else {
            $newpassmsg = $langTXT[36] . " <b>" . htmlspecialchars($newpassword, ENT_QUOTES) . "</b>.";
        }
        
        // save new password to database
        $rt = $modx->changeWebUserPassword($oldpassword,$newpassword);
        if($rt!==true) {
            $output = webLoginAlert($langTXT[37] . ": $rt",$alerttpl);
            return;
        }        
        
        // display change notification
        $tpl = $tpls[1];
        $tpl = str_replace("[+newpassmsg+]",$newpassmsg,$tpl);    
        $output .= $tpl;
    }
    else {    
        $output = webLoginAlert($langTXT[38],$alerttpl).$tpl;
        return;
    }
}

// Returns Default WebChangePwd tpl
function getWebChangePwdtpl(){
    ob_start();
    ?>
    <!-- #declare:separator <hr> --> 
    <!-- login form section-->
    <form method="post" name="changepwdfrm" action="[+action+]" style="margin: 0px; padding: 0px;">
      <table border="0" cellpadding="1" width="300">
        <tr>
          <td><fieldset style="width:300px">
          <legend><b>Введите ваш текущий пароль</b></legend>
          <table border="0" cellpadding="0" style="margin-left:20px;">
            <tr>
              <td style="padding:0px 0px 0px 0px;">
              <label for="oldpassword" style="width:120px">Текущий пароль:</label>
              </td>
              <td style="padding:0px 0px 0px 0px;">
              <input type="password" name="oldpassword" size="20" /><br />
              </td>
            </tr>
          </table>
          </fieldset> <fieldset style="width:300px">
          <legend><b>Способ задания нового пароля</b></legend>
          <input type="radio" name="passwordgenmethod" value="g" checked />Позволить сайту сгенерировать пароль.<br />
          <input type="radio" name="passwordgenmethod" value="spec" />Я сам задам пароль:<br />
          <div style="padding-left:20px">
            <table border="0" cellpadding="0">
              <tr>
                <td style="padding:0px 0px 0px 0px;">
                <label for="specifiedpassword" style="width:120px">Новый пароль:</label>
                </td>
                <td style="padding:0px 0px 0px 0px;">
                <input type="password" name="specifiedpassword" onchange="documentdirty=true;" onkeypress="document.changepwdfrm.passwordgenmethod[1].checked=true;" size="20" /><br />
                </td>
              </tr>
              <tr>
                <td style="padding:0px 0px 0px 0px;">
                <label for="confirmpassword" style="width:120px">Подтвердить новый пароль:</label>
                </td>
                <td style="padding:0px 0px 0px 0px;">
                <input type="password" name="confirmpassword" onchange="documentdirty=true;" onkeypress="document.changepwdfrm.passwordgenmethod[1].checked=true;" size="20" /><br />
                </td>
              </tr>
            </table>
            <small><span class="warning" style="font-weight:normal">Пароль должен содержать минимум 6 символов.</span></small>
          </div>
          </fieldset><br />
          <fieldset style="width:300px">
          <legend><b>Способ уведомления о новом пароле</b></legend>
          <input type="radio" name="passwordnotifymethod" value="e" />Послать новый пароль по e-mail.<br />
          <input type="radio" name="passwordnotifymethod" value="s" checked />Показать новый пароль на экране.
          </fieldset></td>
        </tr>
        <tr>
          <td align="right"><input type="submit" value="Отправить" name="cmdwebchngpwd" />
          <input type="reset" value="Очистить" name="cmdreset" />
          </td>
        </tr>
      </table>
    </form>
    <hr>
    <!-- notification section -->
    Ваш пароль был удачно изменён.<br /><br />
    [+newpassmsg+]
    <?php 
    $t = ob_get_contents();
    ob_end_clean();
    return $t;
}

?>
