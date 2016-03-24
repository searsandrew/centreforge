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
                                    // Use tinymce.execCommand so that it inserts text into the MCE whether you're focused on it or not.
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
                            ed.windowManager.open( {
                                title: 'Add Bootstrap Column(s)',
                                height: 600,
                                width: 800,
                                items: {
                                    type: 'container',
                                    spacing: 10,
                                    classes: 'cf-bs-column-help',
                                    html: '<div id="cf-bootstrap-shortcodes-help">' +
                                        '<h3>Basic Example</h3>' +
                                        '<pre><code>[bs-row]' +
                                            '<br />&nbsp;&nbsp;&nbsp;&nbsp;[bs-column md=&quot;6&quot;]' +
                                            '<br />&nbsp;&nbsp;&nbsp;&nbsp;...' +
                                            '<br />&nbsp;&nbsp;&nbsp;&nbsp;[/bs-column]' +
                                            '<br />&nbsp;&nbsp;&nbsp;&nbsp;[bs-column md=&quot;6&quot;]' +
                                            '<br />&nbsp;&nbsp;&nbsp;&nbsp;...' +
                                            '<br />&nbsp;&nbsp;&nbsp;&nbsp;[/bs-column]' +
                                        '<br />[/bs-row]</code></pre>' +
                                        '<h3>Row Parameters</h3>' +
                                        '<table class="table table-bordered table-striped">' +
                                            '<thead>' +
                                                '<tr>' +
                                                    '<th>Parameter</th>' +
                                                    '<th>Description</th>' +
                                                    '<th>Required</th>' +
                                                    '<th>Values</th>' +
                                                    '<th>Default</th>' +
                                                '</tr>' +
                                            '</thead>' +
                                            '<tbody>' +
                                                '<tr>' +
                                                    '<td>fluid</td>' +
                                                    '<td>Is the container fluid? (see Bootstrap documentation for details)</td>' +
                                                    '<td>optional</td>' +
                                                    '<td>true, false</td>' +
                                                    '<td>false</td>' +
                                                '</tr>' +
                                                '<tr>' +
                                                    '<td>xclass</td>' +
                                                    '<td>Any extra classes you want to add</td>' +
                                                    '<td>optional</td>' +
                                                    '<td>any text</td>' +
                                                    '<td>none</td>' +
                                                '</tr>' +
                                            '</tbody>' +
                                        '</table>' +
                                        '<h3>Column Parameters</h3>' +
                                        '<table class="table table-bordered table-striped">' +
                                            '<thead>' +
                                                '<tr>' +
                                                    '<th>Parameter</th>' +
                                                    '<th>Description</th>' +
                                                    '<th>Required</th>' +
                                                    '<th>Values</th>' +
                                                    '<th>Default</th>' +
                                                '</tr>' +
                                            '</thead>' +
                                            '<tbody>' +
                                                '<tr>' +
                                                    '<td>xs</td>' +
                                                    '<td>Size of column on extra small screens (less than 768px)</td>' +
                                                    '<td>optional</td>' +
                                                    '<td>1-12</td>' +
                                                    '<td>false</td>' +
                                                '</tr>' +
                                                '<tr>' +
                                                    '<td>sm</td>' +
                                                    '<td>Size of column on small screens (greater than 768px)</td>' +
                                                    '<td>optional</td>' +
                                                    '<td>1-12</td>' +
                                                    '<td>false</td>' +
                                                '</tr>' +
                                                '<tr>' +
                                                    '<td>md</td>' +
                                                    '<td>Size of column on medium screens (greater than 992px)</td>' +
                                                    '<td>optional</td>' +
                                                    '<td>1-12</td>' +
                                                    '<td>false</td>' +
                                                '</tr>' +
                                                '<tr>' +
                                                    '<td>lg</td>' +
                                                    '<td>Size of column on large screens (greater than 1200px)</td>' +
                                                    '<td>optional</td>' +
                                                    '<td>1-12</td>' +
                                                    '<td>false</td>' +
                                                '</tr>' +
                                                '<tr>' +
                                                    '<td>offset_xs</td>' +
                                                    '<td>Offset on extra small screens</td>' +
                                                    '<td>optional</td>' +
                                                    '<td>1-12</td>' +
                                                    '<td>false</td>' +
                                                '</tr>' +
                                                '<tr>' +
                                                    '<td>offset_sm</td>' +
                                                    '<td>Offset on small screens</td>' +
                                                    '<td>optional</td>' +
                                                    '<td>1-12</td>' +
                                                    '<td>false</td>' +
                                                '</tr>' +
                                                '<tr>' +
                                                    '<td>offset_md</td>' +
                                                    '<td>Offset on column on medium screens</td>' +
                                                    '<td>optional</td>' +
                                                    '<td>1-12</td>' +
                                                    '<td>false</td>' +
                                                '</tr>' +
                                                '<tr>' +
                                                    '<td>offset_lg</td>' +
                                                    '<td>Offset on column on large screens</td>' +
                                                    '<td>optional</td>' +
                                                    '<td>1-12</td>' +
                                                    '<td>false</td>' +
                                                '</tr>' +
                                                '<tr>' +
                                                    '<td>pull_xs</td>' +
                                                    '<td>Pull on extra small screens</td>' +
                                                    '<td>optional</td>' +
                                                    '<td>1-12</td>' +
                                                    '<td>false</td>' +
                                                '</tr>' +
                                                '<tr>' +
                                                    '<td>pull_sm</td>' +
                                                    '<td>Pull on small screens</td>' +
                                                    '<td>optional</td>' +
                                                    '<td>1-12</td>' +
                                                    '<td>false</td>' +
                                                '</tr>' +
                                                '<tr>' +
                                                    '<td>pull_md</td>' +
                                                    '<td>Pull on column on medium screens</td>' +
                                                    '<td>optional</td>' +
                                                    '<td>1-12</td>' +
                                                    '<td>false</td>' +
                                                '</tr>' +
                                                '<tr>' +
                                                    '<td>pull_lg</td>' +
                                                    '<td>Pull on column on large screens</td>' +
                                                    '<td>optional</td>' +
                                                    '<td>1-12</td>' +
                                                    '<td>false</td>' +
                                                '</tr>' +
                                                '<tr>' +
                                                    '<td>push_xs</td>' +
                                                    '<td>Push on extra small screens</td>' +
                                                    '<td>optional</td>' +
                                                    '<td>1-12</td>' +
                                                    '<td>false</td>' +
                                                '</tr>' +
                                                '<tr>' +
                                                    '<td>push_sm</td>' +
                                                    '<td>Push on small screens</td>' +
                                                    '<td>optional</td>' +
                                                    '<td>1-12</td>' +
                                                    '<td>false</td>' +
                                                '</tr>' +
                                                '<tr>' +
                                                    '<td>push_md</td>' +
                                                    '<td>Push on column on medium screens</td>' +
                                                    '<td>optional</td>' +
                                                    '<td>1-12</td>' +
                                                    '<td>false</td>' +
                                                '</tr>' +
                                                '<tr>' +
                                                    '<td>push_lg</td>' +
                                                    '<td>Push on column on large screens</td>' +
                                                    '<td>optional</td>' +
                                                    '<td>1-12</td>' +
                                                    '<td>false</td>' +
                                                '</tr>' +
                                                '<tr>' +
                                                    '<td>xclass</td>' +
                                                    '<td>Any extra classes you want to add</td>' +
                                                    '<td>optional</td>' +
                                                    '<td>any text</td>' +
                                                    '<td>none</td>' +
                                                '</tr>' +
                                                '<tr>' +
                                                    '<td>data</td>' +
                                                    '<td>Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at <a href="#button-dropdowns">Button Dropdowns</a>).</td>' +
                                                    '<td>optional</td>' +
                                                    '<td>any text</td>' +
                                                    '<td>none</td>' +
                                                '</tr>' +
                                            '</tbody>' +
                                        '</table>' +
                                    '</div>'
                                },
                                buttons: [{
                                    text: 'Insert Basic Example',
                                    classes: 'primary',
                                    onclick: function(e) {    
                                        ed.focus();
                                        tinymce.execCommand('mceInsertContent', false, '[bs-row]' +
                                            '<br />&nbsp;&nbsp;&nbsp;&nbsp;[bs-column md=&quot;6&quot;]' +
                                            '<br />&nbsp;&nbsp;&nbsp;&nbsp;...' +
                                            '<br />&nbsp;&nbsp;&nbsp;&nbsp;[/bs-column]' +
                                            '<br />&nbsp;&nbsp;&nbsp;&nbsp;[bs-column md=&quot;6&quot;]' +
                                            '<br />&nbsp;&nbsp;&nbsp;&nbsp;...' +
                                            '<br />&nbsp;&nbsp;&nbsp;&nbsp;[/bs-column]' +
                                        '<br />[/bs-row]');
                                        ed.windowManager.close();
                                    } 
                                },
                                {
                                    text: 'Close',
                                    onclick: 'close'
                                }]
                            });
                        }
                    },
                    {
                        text: 'Alert', 
                        onclick: function() {
                            ed.windowManager.open({
                                title: 'Add an Alert',
                                body: [{
                                    type: 'listbox', 
                                    name: 'alertType', 
                                    label: 'Alert Type',
                                    values: [{
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
                                    }],
                                }, {
                                    type: 'listbox', 
                                    name: 'alertDismissable', 
                                    label: 'Is the alert dismissable?',
                                    values: [{
                                        text: 'No',
                                        value: 0
                                    }, {
                                        text: 'Yes',
                                        value: 1
                                    }],
                                }],
                                onsubmit: function(e) {    
                                    ed.focus();
                                    // Use tinymce.execCommand so that it inserts text into the MCE whether you're focued on it or not.
                                    if(e.data.alertDismissable) {
                                        tinymce.execCommand('mceInsertContent', false, '[bs-alert type="' + e.data.alertType + '" dismissable="' + e.data.alertDismissable + '"]Alert Content Here[/bs-alert]');
                                    } else {
                                        tinymce.execCommand('mceInsertContent', false, '[bs-alert type="' + e.data.alertType + '"]Alert Content Here[/bs-alert]');
                                    }
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
                                        value: 'lg'
                                    }, {
                                        text: 'Default',
                                        value: ''
                                    }, {
                                        text: 'Small',
                                        value: 'sm'
                                    }, {
                                        text: 'Extra Small',
                                        value: 'xs'
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