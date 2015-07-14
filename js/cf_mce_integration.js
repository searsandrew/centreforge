(function(){
	tinymce.create('tinymce.plugins.cfmcebutton', {
		init : function(ed, url) {
           ed.addButton( 'button_eek', {
                title : 'Insert shortcode',
                image : '../wp-includes/images/smilies/icon_eek.gif',
                onclick : function() {
                     ed.selection.setContent('[myshortcode]');
                }
           });
           ed.addButton( 'pdflink_button', {
                title : 'Add span',
                image : url + '/../images/pdf.png',
                cmd: 'pdf_link_cmd'
           });
           ed.addCommand( 'pdf_link_cmd', function() {
                var selected_text = ed.selection.getContent();
                var return_text = '';
                return_text = '[pdf-link url=""]' + selected_text + '[/pdf-link]';
                ed.execCommand('mceInsertContent', 0, return_text);
           });
           ed.addButton( 'cfmce_button', {
           		title: 'Content Rotator',
           		class: 'bxbutton',
           		onclick : function() {
					var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
					W = W - 80;
					H = H - 84;
					tb_show( 'Content Rotator', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=bxslider-form' );
				}
           })
      },
      createControl : function(n, cm) {
           return null;
      },
	});
	
	tinymce.PluginManager.add('cfmcebutton', tinymce.plugins.cfmcebutton);

	jQuery(function(){
		var form = jQuery('<div id="bxslider-form"><table id="bxslider-table" class="form-table">\
		<p>To use a rotator in your content, start by selecting the options you want for the rotator here. Then us the slides button to the right to add a new slide. An example slide will be generated for you.</p>\
		<tr>\
			<th><label for="bxslider-mode">Mode</label></th>\
			<td><select name="mode" id="bxslider-mode">\
				<option value="horizontal">Horizontal</option>\
				<option value="vertical">Vertical</option>\
				<option value="fade">Fade</option>\
			</select><br />\
			<small>Type of transition between slides.</small></td>\
		</tr>\
		<tr>\
			<th><label for="bxslider-speed">Speed</label></th>\
			<td><input type="text" id="bxslider-speed" name="speed" value="500" /><br />\
			<small>Slide transition duration (in ms).</small></td>\
		</tr>\
		<tr>\
			<th><label for="bxslider-infiniteLoop">Infinite Loop</label></th>\
			<td><select name="infiniteLoop" id="bxslider-infiniteLoop">\
				<option value="true">True</option>\
				<option value="false">False</option>\
			</select><br />\
			<small>If true, clicking <code>Next</code> while on the last slide will transition to the first slide and vice-versa.</small></td>\
		</tr>\
		<tr>\
			<th><label for="bxslider-captions">Captions</label></th>\
			<td><select name="captions" id="bxslider-captions">\
				<option value="true">True</option>\
				<option value="false" selected="selected">False</option>\
			</select><br />\
			<small>Include image captions. Captions are derived from the image\'s <code>title</code> attribute</small></td>\
		</tr>\
		<tr>\
			<th><label for="bxslider-ticker">Ticker</label></th>\
			<td><select name="ticker" id="bxslider-ticker">\
				<option value="true">True</option>\
				<option value="false" selected="selected">False</option>\
			</select><br />\
			<small>Use slider in ticker mode (similar to a news ticker)</small></td>\
		</tr>\
		<tr>\
			<th><label for="bxslider-video">Video</label></th>\
			<td><select name="video" id="bxslider-video">\
				<option value="true">True</option>\
				<option value="false" selected="selected">False</option>\
			</select><br />\
			<small>If any slides contain video, set this to <code>true</code>.</small></td>\
		</tr>\
		<tr style="border-top:1px solid darkgray;">\
			<th><label for="bxslider-pager">Pager</label></th>\
			<td><select name="pager" id="bxslider-pager">\
				<option value="true">True</option>\
				<option value="false">False</option>\
			</select><br />\
			<small>If <code>true</code>, a pager will be added.</td>\
		</tr>\
		<tr>\
			<th><label for="bxslider-pagerType">Pager</label></th>\
			<td><select name="pagerType" id="bxslider-pagerType">\
				<option value="full">Full</option>\
				<option value="short">Short</option>\
			</select><br />\
			<small>If <code>full</code>, a pager link will be generated for each slide. If <code>short</code>, a x / y pager will be used (ex. 1 / 5)</td>\
		</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="bxslider-submit" class="button-primary" value="Insert Rotator" name="submit" />\
		</p>\
		</div>');
		
		var table = form.find('table');
		form.appendTo('body').hide();
		form.find('#bxslider-submit').click(function(){
			var options = { 
				'mode'	: 'horizontal',
				'speed'	: '500',
				'infiniteLoop'	: 'true',
				'captions'	: 'false',
				'ticker'	: 'false',
				'video'	: 'false',
				'pager'	: 'true',
				'pagerType'	: 'full'
				};
			var shortcode = '[bxslider';
			
			for( var index in options) {
				var value = table.find('#bxslider-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			shortcode += ']<br/>Insert Your Slides Here.<br/>[/bxslider]<br/>';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})()