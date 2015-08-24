(function(){
    /* Sources:
    * http://www.tinymce.com/tryit/menubutton.php
    */
    tinymce.create('tinymce.plugins.cfmcebutton', {
		
        init : function(ed, url) {
            
           ed.addButton( 'shortcodes', {
                type: 'menubutton',
                text: 'Shortcodes',
                icon: false,
                menu: [
                    {
                        text: 'Add PDF Link', 
                        onclick : function() {
                            ed.windowManager.open({
                                title: 'Add PDF Link',
                                body: [
                                    {type: 'textbox', name: 'docLink', label: 'Link to Document'}
                                ],
                                onsubmit: function(e) {    
                                    ed.focus();
                                    // Use tinymce.execCommand so that it inserts text into the MCE whether you're focued on it or not.
                                    tinymce.execCommand('mceInsertContent', false, '[pdf-icon url="' + e.data.docLink + '"]Link Text Here[/pdf-icon]');
                                    // Old exec code.  Only inserts into the text editor if you're focused on it.
                                    // ed.selection.setContent('[testcode attr="' + e.data.label1 + '"]Your stuff here[/testcode]');
                                }
                            });
                        }
                    },
                    {
                        text: 'Bootstrap Column(s)', 
                        onclick: function() {
                            ed.windowManager.open({
                                title: 'Add Bootstrap Column(s)',
                                body: [{
                                    type: 'listbox', 
                                    name: 'colSpanNumber', 
                                    label: 'Column Span Length',
                                    values: [{
                                        text: 'Span 1 Column',
                                        value: '1'
                                    }, {
                                        text: 'Span 2 Columns',
                                        value: '2'
                                    }, {
                                        text: 'Span 3 Columns',
                                        value: '3'
                                    }, {
                                        text: 'Span 4 Columns',
                                        value: '4'
                                    }, {
                                        text: 'Span 5 Columns',
                                        value: '5'
                                    }, {
                                        text: 'Span 6 Columns',
                                        value: '6'
                                    }, {
                                        text: 'Span 7 Columns',
                                        value: '7'
                                    }, {
                                        text: 'Span 8 Columns',
                                        value: '8'
                                    }, {
                                        text: 'Span 9 Columns',
                                        value: '9'
                                    }, {
                                        text: 'Span 10 Columns',
                                        value: '10'
                                    }, {
                                        text: 'Span 11 Columns',
                                        value: '11'
                                    }, {
                                        text: 'Span 12 Columns',
                                        value: '12'
                                    }],
                                }, {
                                    type: 'listbox', 
                                    name: 'colSize', 
                                    label: 'Break column at what size?',
                                    values: [{
                                        text: 'Keep size on all devices (xs)',
                                        value: 'xs'
                                    }, {
                                        text: 'Keep size until 720px and Lower (sm)',
                                        value: 'sm'
                                    }, {
                                        text: 'Keep size until 900px and Lower (md)',
                                        value: 'md'
                                    }, {
                                        text: 'Keep size until 1080px and Lower (lg)',
                                        value: 'lg'
                                    }],
                                }, {
                                    type: 'listbox', 
                                    name: 'colRow', 
                                    label: 'Does this column start or end a row? (first or last)',
                                    values: [{
                                        text: 'Is neither the first or last column',
                                        value: ''
                                    }, {
                                        text: 'Is the first column',
                                        value: 'first'
                                    }, {
                                        text: 'Is the last column',
                                        value: 'last'
                                    }],
                                }],
                                onsubmit: function(e) {    
                                    ed.focus();
                                    // Use tinymce.execCommand so that it inserts text into the MCE whether you're focued on it or not.
                                    tinymce.execCommand('mceInsertContent', false, '[bs-columns col="' + e.data.colSpanNumber + '" size="' + e.data.colSize + '" row="' + e.data.colRow + '"]Column Content Here[/bs-columns]');
                                }
                            });
                        }
                    },
                    {
                        text: 'Media Object', 
                        onclick: function() {
                            ed.windowManager.open({
                                title: 'Add Media Object',
                                body: [{
                                    type: 'listbox', 
                                    name: 'list', 
                                    label: 'Is this a list?',
                                    values: [{
                                        text: 'Yes',
                                        value: 'TRUE'
                                    }, {
                                        text: 'No',
                                        value: ''
                                    }],
                                }, {
                                    type: 'textbox', 
                                    name: 'title', 
                                    label: 'Title'
                                }, {
                                    type: 'textbox', 
                                    name: 'url', 
                                    label: 'URL'
                                }, {
                                    type: 'textbox', 
                                    name: 'img', 
                                    label: 'Image'
                                }, {
                                    type: 'listbox', 
                                    name: 'horizontal', 
                                    label: 'Horizontal',
                                    values: [{
                                        text: 'Left',
                                        value: 'left'
                                    }, {
                                        text: 'Right',
                                        value: 'right'
                                    }],
                                }, {
                                    type: 'listbox', 
                                    name: 'vertical', 
                                    label: 'Vertical',
                                    values: [{
                                        text: 'Top',
                                        value: 'top'
                                    }, {
                                        text: 'Middle',
                                        value: 'middle'
                                    }, {
                                        text: 'Bottom',
                                        value: 'bottom'
                                    }],
                                }, {
                                    type: 'listbox', 
                                    name: 'heading', 
                                    label: 'Heading Size',
                                    values: [{
                                        text: 'Heading 1',
                                        value: '1'
                                    }, {
                                        text: 'Heading 2',
                                        value: '2'
                                    }, {
                                        text: 'Heading 3',
                                        value: '3'
                                    }, {
                                        text: 'Heading 4',
                                        value: '4'
                                    }, {
                                        text: 'Heading 5',
                                        value: '5'
                                    }],
                                }],
                                onsubmit: function(e) {    
                                    ed.focus();
                                    // Use tinymce.execCommand so that it inserts text into the MCE whether you're focued on it or not.
                                    tinymce.execCommand('mceInsertContent', false, '[media list="' + e.data.list + '" title="' + e.data.title + '" url="' + e.data.url + '" img="' + e.data.img + '" horizontal="' + e.data.horizontal + '" vertical="' + e.data.vertical + '" heading="' + e.data.heading + '"]Media Object Content Here[/media]');
                                }
                            });
                        }
                    },
                    {
                        text: 'List Group', 
                        onclick: function() {
                            ed.windowManager.open({
                                title: 'Add List Group',
                                body: [{
                                    type: 'textbox', 
                                    name: 'title', 
                                    label: 'Title'
                                }, {
                                    type: 'listbox', 
                                    name: 'first', 
                                    label: 'Is this the first item in the group?',
                                    values: [{
                                        text: 'Yes',
                                        value: 'true'
                                    }, {
                                        text: 'No',
                                        value: 'false'
                                    }],
                                }, {
                                    type: 'listbox', 
                                    name: 'last', 
                                    label: 'Is this the last item in the group?',
                                    values: [{
                                        text: 'Yes',
                                        value: 'true'
                                    }, {
                                        text: 'No',
                                        value: 'false'
                                    }],
                                }],
                                onsubmit: function(e) {    
                                    ed.focus();
                                    // Use tinymce.execCommand so that it inserts text into the MCE whether you're focued on it or not.
                                    tinymce.execCommand('mceInsertContent', false, '[list-group title="' + e.data.title + '" first="' + e.data.first + '" last="' + e.data.last + '"]List Group Content Here[/list-group]');
                                }
                            });
                        }
                    },
                    {
                        text: 'Button', 
                        onclick: function() {
                            ed.windowManager.open({
                                title: 'Add List Group',
                                body: [{
                                    type: 'textbox', 
                                    name: 'url', 
                                    label: 'URL'
                                }, {
                                    type: 'listbox', 
                                    name: 'class', 
                                    label: 'Class',
                                    values: [{
                                        text: 'Default',
                                        value: 'default'
                                    }, {
                                        text: 'Primary',
                                        value: 'primary'
                                    }, {
                                        text: 'Success',
                                        value: 'success'
                                    }, {
                                        text: 'Info',
                                        value: 'info'
                                    }, {
                                        text: 'Warning',
                                        value: 'warning'
                                    }, {
                                        text: 'Danger',
                                        value: 'danger'
                                    }, {
                                        text: 'Link',
                                        value: 'link'
                                    }],
                                }, {
                                    type: 'listbox', 
                                    name: 'size', 
                                    label: 'Button Size',
                                    values: [{
                                        text: 'Large',
                                        value: 'btn-lg'
                                    }, {
                                        text: 'Default',
                                        value: ''
                                    }, {
                                        text: 'Small',
                                        value: 'btn-sm'
                                    }, {
                                        text: 'Extra Small',
                                        value: 'btn-xs'
                                    }],
                                }],
                                onsubmit: function(e) {    
                                    ed.focus();
                                    // Use tinymce.execCommand so that it inserts text into the MCE whether you're focued on it or not.
                                    tinymce.execCommand('mceInsertContent', false, '[button url="' + e.data.url + '" class="' + e.data.class + '" size="' + e.data.size + '"]Button Text Here[/button]');
                                }
                            });
                        }
                    },
                    {
                        text: 'Modal Window', 
                        onclick: function() {
                            ed.windowManager.open({
                                title: 'Add Modal Window',
                                body: [{
                                    type: 'textbox', 
                                    name: 'button', 
                                    label: 'Button Text'
                                }, {
                                    type: 'listbox', 
                                    name: 'btnopenclass', 
                                    label: 'Open Button Class',
                                    values: [{
                                        text: 'Default',
                                        value: 'default'
                                    }, {
                                        text: 'Primary',
                                        value: 'primary'
                                    }, {
                                        text: 'Success',
                                        value: 'success'
                                    }, {
                                        text: 'Info',
                                        value: 'info'
                                    }, {
                                        text: 'Warning',
                                        value: 'warning'
                                    }, {
                                        text: 'Danger',
                                        value: 'danger'
                                    }, {
                                        text: 'Link',
                                        value: 'link'
                                    }],
                                }, {
                                type: 'textbox', 
                                    name: 'title', 
                                    label: 'Modal Title'
                                }, {
                                    type: 'listbox', 
                                    name: 'btncloseclass', 
                                    label: 'Close Button Class',
                                    values: [{
                                        text: 'Default',
                                        value: 'default'
                                    }, {
                                        text: 'Primary',
                                        value: 'primary'
                                    }, {
                                        text: 'Success',
                                        value: 'success'
                                    }, {
                                        text: 'Info',
                                        value: 'info'
                                    }, {
                                        text: 'Warning',
                                        value: 'warning'
                                    }, {
                                        text: 'Danger',
                                        value: 'danger'
                                    }, {
                                        text: 'Link',
                                        value: 'link'
                                    }],
                                }, {
                                    type: 'textbox', 
                                    name: 'footer', 
                                    label: 'Modal Footer'
                                }, {
                                    type: 'listbox', 
                                    name: 'modalsize', 
                                    label: 'Modal Size',
                                    values: [{
                                        text: 'Default',
                                        value: ''
                                    }, {
                                        text: 'Large',
                                        value: 'modal-lg'
                                    }, {
                                        text: 'Small',
                                        value: 'modal-sm'
                                    }],
                                }, {
                                    type: 'textbox', 
                                    name: 'modalid', 
                                    label: 'Modal ID (Must be unique from any other modal on this page)'
                                }],
                                onsubmit: function(e) {    
                                    ed.focus();
                                    // Use tinymce.execCommand so that it inserts text into the MCE whether you're focued on it or not.
                                    tinymce.execCommand('mceInsertContent', false, '[modal button="' + e.data.button + '" btnopenclass="' + e.data.btnopenclass + '" title="' + e.data.title + '" btncloseclass="' + e.data.btncloseclass + '" footer="' + e.data.footer + '" modalsize="' + e.data.modalsize + '" modalid="' + e.data.modalid + '"]Modal Text Here[/modal]');
                                }
                            });
                        }
                    },
                    {
                        text: 'Logged In Text', 
                        onclick: function() {
                            ed.windowManager.open({
                                title: 'Add Logged In Only Text',
                                body: [{
                                    type: 'textbox', 
                                    name: 'no', 
                                    label: 'Not Logged In Text'
                                }],
                                onsubmit: function(e) {    
                                    ed.focus();
                                    // Use tinymce.execCommand so that it inserts text into the MCE whether you're focued on it or not.
                                    tinymce.execCommand('mceInsertContent', false, '[loggedin no="' + e.data.no + '"]Logged In people will see text here.[/loggedin]');
                                }
                            });
                        }
                    }
                ]

            });
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