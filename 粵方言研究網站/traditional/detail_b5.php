<html><head>
<TITLE>��s�ؿ����</TITLE>
<!-- by: bernard@bernardtsang.com -->

<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<LINK REL="stylesheet" HREF="style.css" TYPE="text/css">

</head>

<body SPACING="0" marginheight="0" marginwidth="0" topmargin="0" leftmargin="0" >

<table border="0" cellpadding="0" cellspacing="0" width="585">
  <tr> 
    <td width="7"></td>
    <td width="577">                                <img width=577 src=pic/landscape1.gif><table border=0 cellspacing=0 cellpadding=0 width="100%" bgcolor="#d40000"><tr><td><img src="t.gif" width="1" height="1"></td></tr>
      </table>
      <table width=100% cellspacing=0 cellpadding=0 border=0>
        <tr> 
          <td width=400 valign=top><br> 
            <H1 align=left>��s�ؿ����</H1> 


            <table width=95% cellspacing=0 cellpadding=1 border=0>
              <tr> 
                  <td>

<?php
   $link = mysql_connect("localhost:3306", "cantones", "LingCant")
          or die("Could not connect");
   mysql_select_db("linguistics", $link) or die("Could not select database");

   $query = "SELECT author_b5,title_b5,source_b5,year,rem_b5 FROM CantPubl_B5 WHERE publid=${id}";

   $result = mysql_query($query) or die("Query failed");

   print "<table width=378 cellpadding=3 cellspacing=1>\n";
   while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	printf ("\t<TR valign=top><TD width=58 bgcolor=#000000><font class=whi>�@��</font></td><td width=319 bgcolor=#f0f0f0>%s</td></TR>\n", $row["author_b5"]);
	printf ("\t<TR valign=top><TD bgcolor=#000000><font class=whi>�g�W</font></td><td bgcolor=#f0f0f0>%s</td></TR>\n", $row["title_b5"]);
	printf ("\t<TR valign=top><TD bgcolor=#000000><font class=whi>�X�B</font></td><td bgcolor=#f0f0f0>%s</td></TR>\n", $row["source_b5"]);
	printf ("\t<TR valign=top><TD bgcolor=#000000><font class=whi>�X���~��</font></td><td bgcolor=#f0f0f0>%s</td></TR>\n", $row["year"]);
	printf ("\t<TR valign=top><TD bgcolor=#000000><font class=whi>�Ƶ�</font></td><td bgcolor=#f0f0f0>%s</td></TR>\n", $row["rem_b5"]);
   }
   print "</table>\n";

   /* Free resultset */
   mysql_free_result($result);

   /* Closing connection */
   mysql_close($link);
?>

                  </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table>
            <br>  
          </td>
          <td width=1 ><img src="t.gif" width=1 height=1></td>
          <td width=177 valign=top > 
            <table border=0 cellspacing=0 cellpadding=3 width="100%">
              <tr> 
                <td valign="top" align=right><img src="pic/right1.jpg" border=0 width="157" height="345"></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
    <td width="2" bgcolor=d40000><img src="t.gif" width=1 height=1></td>
  </tr>
  
<tr> 
    <td width="7"></td>
    <td align=right valign="center">&nbsp;</td>  
  </tr>
</table>

</body></html>
