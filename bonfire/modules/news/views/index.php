<style type="text/css">
	body {
		background: #ceceaf url(/bonfire/themes/sports/images/background2.png) 0 1px repeat-x;
	}

</style>

<br />
<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
	<div id="news">

		<?php foreach ($records as $record) : ?>
			
		<?php $record = (array)$record;?>
		<div id="new" style="height:auto; width: 100%;">
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
				<?php $tit_value=$value ;?>
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
				<?php $img_value=$value ;?>
				<div id="<?php echo $field ;?>">
					<!--<a href="<?php echo 'http://easyvictory.com.ua/news/index/' .$id ;?>"><img src="<?php echo '/images/uploads/' .$value ;?>" /></a>-->
					<img src="<?php echo Template::theme_url() .'images/uploads/' .$value ;?>" />
				</div>
				<?php endif; ?> 
				
				<?php if (($field == 'news_short')) : ?>
				<div id="<?php echo $field ;?>" style="font-size: 18px; color: #61380B;"> <!--79a0cc-->
					<p><?php echo  $value; ?></p>
					<div class='publish'>
						<!--<span class='st_vkontakte_hcount' displayText='Поделиться'></span>
						<span class="st_sharethis"></span>
						<span class='st_vkontakte_hcount' displayText='Поделиться'></span>
						<span class='st_plusone_hcount' displayText='Google +1'></span>
						<span class='st_fblike_hcount' displayText='Facebook'></span>
						<span class='st_twitter_hcount' displayText='Tweet'></span-->
						<span class="st_vkontakte_large" st_title='<?php echo $tit_value ;?>' st_image='<?php echo $img_value ;?>'></span>
						<span class="st_facebook_large" st_title='<?php echo $tit_value ;?>'></span>
						<span class="st_twitter_large" st_title='<?php echo $tit_value ;?>'></span>
						<span class="st_odnoklassniki_large" st_title='<?php echo $tit_value ;?>'></span>
						<span class="st_google_large" st_title='<?php echo $tit_value ;?>'></span>

						
					</div>
				</div>
				<?php endif; ?>
				
				<?php if (($field == 'news_text')) : ?>
				<div id="<?php echo $field ;?>">
					<p><?php echo  $value; ?></p>
				</div>
				<?php endif; ?>
				
				<?php if (($field == 'news_author')and($value!='')) : ?>
				<div id="<?php echo $field ;?>">
					<p> Источник: <?php echo  $value; ?></p>
				</div>
				<?php endif; ?>
				
			<?php endforeach; ?>
		</div>
		<?php endforeach; ?>

	</div>
	
<?php endif; ?>
