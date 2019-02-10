<?php
/**
 * Template part for displaying carte de visite
 *
 * @package iacs
 */


the_post();
$meta = get_post_meta(get_the_ID());
?>

<style type="text/css">
<!--
body  {
	font: 100% Verdana, Arial, Helvetica, sans-serif;
	margin: 0; /* it's good practice to zero the margin and padding of the body element to account for differing browser defaults */
	text-align: center; /* this centers the container in IE 5* browsers. The text is then set to the left aligned default in the #container selector */
	color: #000000;
	background-color: #FFFFFF;
  overflow:hidden;
	width:620px;
}
.twoColFixRtHdr #container {
	width: 630px;  /* using 20px less than a full 800px width allows for browser chrome and avoids a horizontal scroll bar */
	background: #FFFFFF;
	margin: 0 auto;
	text-align: left; /* this overrides the text-align: center on the body element. */
	margin-bottom: 0px;
	margin-left: 0px;
	margin-right: 0px;
	margin-top: 0px;
}
.twoColFixRtHdr #header {
	background-color: #FFFFFF;
	padding-right: 5px;
	padding-left: 5px;
}
.twoColFixRtHdr #header h1 {
	margin: 0; /* zeroing the margin of the last element in the #header div will avoid margin collapse - an unexplainable space between divs. If the div has a border around it, this is not necessary as that also avoids the margin collapse */
	padding: 10px 0; /* using padding instead of margin will allow you to keep the element away from the edges of the div */
	font-family: Verdana, Arial, Helvetica, sans-serif;
	background-color: #FFFFFF;
}
.twoColFixRtHdr #sidebar1 {
	float: right; /* since this element is floated, a width must be given */
	width: 100px;
	margin-top: 20px;
	height: 49px;
	border-left-width: 0px;
	border-top-width: 0px;
	border-right-width: 0px;
	border-bottom-width: 0px;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
}
.twoColFixRtHdr #mainContent {
	margin-top: 0;
	margin-right: 250px;
	margin-bottom: 0;
	margin-left: 0;
	padding-top: 0;
	padding-right: 20px;
	padding-bottom: 10px;
	padding-left: 20px;
}
.twoColFixRtHdr #footer {
	padding: 0 10px 0 20px; /* this padding matches the left alignment of the elements in the divs that appear above it. */
	background:#DDDDDD;
}
.twoColFixRtHdr #footer p {
	margin: 0; /* zeroing the margins of the first element in the footer will avoid the possibility of margin collapse - a space between divs */
	padding: 10px 0; /* padding on this element will create space, just as the the margin would have, without the margin collapse issue */
}
.fltrt { /* this class can be used to float an element right in your page. The floated element must precede the element it should be next to on the page. */
	float: right;
	margin-left: 8px;
}
.fltlft { /* this class can be used to float an element left in your page */
	float: left;
	margin-right: 8px;
}
.clearfloat { /* this class should be placed on a div or break element and should be the final element before the close of a container that should fully contain a float */
	clear:both;
    height:0;
    font-size: 1px;
    line-height: 0px;
}
.style1 {
	font-size: small;
	color: #666666;
}
td,tr {
  text-align:left;
}
td {
	width:430px;
}
#container {
  padding-top:1.2em;
  overflow:hidden;
  width:620px;
	padding-left:0.6em;
}
#container table {
	width:620px;
}
#addr {
  line-height:1.9em;
  font-size:0.8em;
}
#footer_info {
	text-align:left;
	background:#E4ECF2;
	width:620px;
	padding:0.6em 0.6em;
}
-->
</style>
<body>
<div id="container"><ins>
  </ins><ins>  </ins>
  <div id="header">
    <table border="0">
      <tr>
        <td height="77" colspan="2" nowrap="nowrap" class="twoColFixRtHdr">
          <h2><?php echo esc_html($meta['iacscarte_name'][0]);?></h2>
          <h3><?php echo esc_html($meta['iacscarte_title'][0]);?></h3>
        </td>
        <th width="153">
          <img
          src="<?php echo get_bloginfo('template_url') ?>/img/iacsLogo_2017.png"
          alt=""
          name="iacsLogo"
          width="152"
          height="67"
          border="0"
          align="absmiddle"
          id="iacsLogo" />
        </th>
      </tr>
      <tr>
        <td colspan="2">
          <span class="style1">
            <strong><?php echo esc_html($meta['iacscarte_institute'][0]);?></strong>
          </span>
        </td>
        <th width="153"
        rowspan="8"
        align="center"
        valign="top"
        nowrap="nowrap">
          <?php echo get_the_post_thumbnail(
            $post=get_the_ID(),
            $size=array( "145","212")
          ); ?>
        </th>
      </tr>
      <tr id="addr">
        <td colspan="2"><p class="style2"><?php
        echo nl2br($meta['iacscarte_address'][0]);
        ?></p></td>
      </tr>
      <tr>
        <td height="20">&nbsp;</td>
        <td height="20">&nbsp;</td>
      </tr>
      <tr>
        <td height="20">&nbsp;</td>
        <td height="20">&nbsp;</td>
      </tr>
      <tr>
        <td height="20">&nbsp;</td>
        <td height="20">&nbsp;</td>
      </tr>
      <tr class="style2">
        <td height="20">e-mail</td>
        <td height="20"><a href="mailto:<?php echo sanitize_email($meta['iacscarte_email'][0]);?>"><?php echo sanitize_email($meta['iacscarte_email'][0]);?></a></td>
      </tr>
      <tr>
        <td height="31" class="style2">web</td>
        <td height="31" class="style2"><a href="<?php echo esc_url($meta['iacscarte_web'][0]);?>" target="_blank"><?php echo esc_html($meta['iacscarte_niceweb'][0]);?></a></td>
        <td width="153">&nbsp;</td>
      </tr>
    </table>
  </div>
  <br class="clearfloat" />
</div>

<p id="footer_info" >
<?php
  $updated_date = '<strong>'.get_the_modified_time('F jS, Y').'</strong>';
  $updated_time = '<strong>'.get_the_modified_time('h:i a').'</strong>';
  echo 'Last updated on '. $updated_date . ' at '. $updated_time .' | ';
?> <a href="mailto:webmaster@cryosphericsciences.org" target="_blank">IACS Webmaster</a></p>
</body>
