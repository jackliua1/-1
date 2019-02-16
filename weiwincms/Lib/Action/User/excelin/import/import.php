
<form action="lead.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="leadExcel" value="true">
   <center>
   <table border="0" style="margin-top:10px;" >
    <tr>
       <td colspan='2'>
        <input type="file" name="inputExcel" size="20"  maxlength="20" />注：只能为.xls
       </td>

    </tr>
	<tr height="50px;">
	  <td style="text-align:center">
	      <input type="submit" value="导入数据" style="width:100px; height:30px;" />
	  </td>
	  <td style="text-align:center;">
	     <input type="button" style="width:100px;height:30px;" value="取消" />
	  </td>
	</tr>
    </table>
	</center>
</form>
