<p>Вы оформили заявку №<?=$model->id_order?> на бронирование площадок</p>

<?php 
$total = 0;

if (!empty($order->places))
{
?>
<table border="1" width="800">
<?php 
	foreach ($order->places as $model)
	{
?>
	<tr>
		<td style="padding:10px;">			
			<?=$model->name?>
		</td>		
		<td style="padding:10px;">			
			<?=$model->time?>
		</td>		
		<td style="padding:10px;">			
			<?=$model->date?>
		</td>		
	</tr>
<?php } ?>
</table>

<?php } ?>

<p>Контактные данные</p>

<table border="1"  width="800">
	<tr>
		<th style="padding:10px;">ФИО</th>
		<td style="padding:10px;"><?=$model->name?></td>
	</tr>
		<th style="padding:10px;">Телефон</th>
		<td style="padding:10px;"><?=$model->phone?></td>
	</tr>
	<tr>
		<th style="padding:10px;">Емейл</th>
		<td style="padding:10px;"><?=$model->email?></td>
	</tr>
</table>