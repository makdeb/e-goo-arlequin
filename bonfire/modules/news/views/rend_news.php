<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>
			
	<div id="news">

		<?php foreach ($records as $record) : ?>
			
		<?php $record = (array)$record;?>
		<div id="new">
				<?php foreach($record as $field => $value) : ?>
				
				<?php if (($field == 'id')) : ?>
					<?php $id = $value;?>
				<?php endif ;?>
				
				<?php if (($field == 'news_date')) : ?>
					<?php $date = mysql_to_unix($value);
						  $date = date('d.m.Y H:i', $date);
					;?>
				<?php endif ;?>		
				
				<?php if (($field == 'news_category')) : ?>
				<?php
				switch ($value):
				    case 'football':
				        $cat_value = "футбол";
				        break;
				    case 'basketball':
				        $cat_value = "баскетбол";
				        break;
				    case 'hockey':
				        $cat_value = "хокей";
				        break;
					case 'tennis':
				        $cat_value = "теннис";
				        break;
					case 'auto':
				        $cat_value = "автоспорт";
				        break;
					case 'box':
				        $cat_value = "бокс";
				        break;
					default:
				        $cat_value = "другие виды";
				endswitch;
				?>
				<?php endif; ?>
				
							
				<?php if (($field == 'news_title')) : ?>
				<div id="<?php echo $field ;?>">
					<a href="<?php echo 'http://localhost/news/index/' .$id ;?>"><?php echo  $value; ?></a>
				</div>
				<?php endif; ?>
				
				<?php if (($field == 'news_category')) : ?>
				<div id="<?php echo $field ;?>" style="<?php echo 'background: #bb3900 url(/images/ico/' .$value .'.png)2px 2px no-repeat' ;?>">
				
					<a href="<?php echo 'http://localhost/news/' .$value ;?>"><?php echo  $cat_value; ?></a>&nbsp;&nbsp;<span><?php echo  $date; ?></span>
				</div>
				<?php endif; ?>
				
				<?php if (($field == 'news_img_path')) : ?>
				<div id="<?php echo $field ;?>">
					<a href="<?php echo 'http://localhost/news/index/' .$id ;?>"><img src="<?php echo '/images/uploads/thumb_' .$value;?>" /></a>
				</div>
				<?php endif; ?> 
				
				
				<?php if (($field == 'news_short')) : ?>
				<div id="<?php echo $field ;?>">
					<p><?php echo  $value; ?></p>
				</div>
				<?php endif; ?>
			

			<?php endforeach; ?>
			<div id="space"></div>
		</div>
		<?php endforeach; ?>

	</div>
<?php endif; ?>

