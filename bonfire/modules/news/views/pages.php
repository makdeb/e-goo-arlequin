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
				        $cat_value = "хоккей";
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
					<a href="<?php echo 'http://easyvictory.com.ua/news/index/' .$id ;?>"><?php echo  $value; ?></a>
				</div>
				<?php endif; ?>
				
				<?php if (($field == 'news_category')) : ?>
				<div id="<?php echo $field ;?>" style="<?php echo 'background: #bb3900 url(' .Template::theme_url() .'images/ico/' .$value .'.png)2px 2px no-repeat' ;?>">
					<a href="<?php echo 'http://easyvictory.com.ua/news/' .$value .'/1' ;?>"><?php echo  $cat_value; ?></a>&nbsp;&nbsp;<span><?php echo  $date; ?></span>
				</div>
				<?php endif; ?>
				
				<?php if (($field == 'news_img_path')and($value!='')) : ?>
				<div id="<?php echo $field ;?>">
					<a href="<?php echo 'http://easyvictory.com.ua/news/index/' .$id ;?>"><img src="<?php echo Template::theme_url() .'images/uploads/thumb_' .$value;?>" /></a>
				</div>
				<?php endif; ?> 
				
				
				<?php if (($field == 'news_short')) : ?>
				<div id="<?php echo $field ;?>">
					<p><?php echo  $value; ?></p><div id="demo1" data-url="http://sharrre.com" data-text="Make your sharing widget with Sharrre (jQuery Plugin)" data-title="share"></div>
				</div>
				<?php endif; ?>
			

			<?php endforeach; ?>
			<div id="space"></div>
		</div>
		<?php endforeach; ?>
		<div id="links"><?php echo $pag_links;?></div>
	</div>
<?php endif; ?>

