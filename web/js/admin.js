/*toastr.options = {
    closeButton: true,
    progressBar: true,
    showMethod: 'slideDown',
    timeOut: 5000
};*/

function getValueById(id)
{
    if ($("#"+id).length>0)
        return $("#"+id).val();

    return '';
}

function removeRow(obj)
{
  var parent = $(obj).parent().parent();

  if (parent.siblings().length>0)
      parent.remove();
  else
      parent.find("input,textarea").val('');

  return false;
}

$(document).on('onInit.fb', function (e, instance) {    

  if ($('.fancybox-buttons').find('#rotate_button').length === 0) {
    $('.fancybox-buttons').prepend('<button id="rotate_button" class="fancybox-button" title="Rotate Image"><i class="bx bx-rotate-left" style="margin-top:12px; font-size:18px; "></i></button>');
    $('.fancybox-buttons').prepend('<button id="print_button" class="fancybox-button" title="Print Image"><i class="bx bx-printer" style="margin-top:12px; font-size:18px; "></i></button>');
  }  

  var click = 0;
  
  $('.fancybox-buttons').on('click', '#rotate_button', function () {
    var n = 90 * ++click;
    $('.fancybox-image').css('webkitTransform', 'rotate(-' + n + 'deg)');
    $('.fancybox-image').css('mozTransform', 'rotate(-' + n + 'deg)');
  });

  $('.fancybox-buttons').on('click', '#print_button', function () {

    function printElement(e) {
      var ifr = document.createElement('iframe');
      ifr.style='height: 0px; width: 0px; position: absolute'
      document.body.appendChild(ifr);

      $(e).clone().appendTo(ifr.contentDocument.body);
      ifr.contentWindow.print();

      ifr.parentElement.removeChild(ifr);
    }

    var instance = $.fancybox.getInstance();

    console.log(instance.current);
    
    if (instance) {
      printElement(instance.current.$image)
    }
  });

});

function setVisisble()
{
    $("div[data-visible-field]").each(function(){

        var source = $("#"+$(this).data('visible-field'));
        var block = $(this);

        function check()
        {
            var values = String(block.data('values')).split(',');

            if (values.indexOf(source.val())<0)
              block.hide();
            else
              block.show();
        }

        if (source.length>0)
        {
          source.change(function(){
            check();
          });

          check();
        }
    });
}

var csrf, csrf_value;

function filePicker(callback, value, meta) {
    var input = document.createElement('input');
    input.setAttribute('type', 'file');
    //input.setAttribute('accept', 'image/*');
    input.click();
}

 $('.redactor').each(function(){
  console.log($(this).attr('id'));
  tinymce.init({selector:'#'+$(this).attr('id'),height:300,plugins:["advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker","searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking","save table contextmenu directionality emoticons template paste textcolor"],toolbar:"insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",style_formats:[{title:"Bold text",inline:"b"},{title:"Red text",inline:"span",styles:{color:"#ff0000"}},{title:"Red header",block:"h1",styles:{color:"#ff0000"}},{title:"Example 1",inline:"span",classes:"example1"},{title:"Example 2",inline:"span",classes:"example2"},{title:"Table styles"},{title:"Table row 1",selector:"tr",classes:"tablerow1"}]});

  /*$(this).redactor({
    removeClasses: true,
    removeStyles: true,
    toolbarFixed: true,
    //linebreaks: true,
    toolbarFixedTopOffset: 60,
    imageUpload: '/upload.php?image=1',
    fileUpload: '/upload.php?file=1',
    //fileDownload: '/admin/default/downloadFile/'
  });*/
});

$('.redactor-mini').each(function(){
  $(this).redactor({
      toolbar: 'mini',
      removeClasses: true,
      removeStyles: true,
  });
});


var tinymceConfig = {
    selector:'.redactor',
    plugins: [
        'link image imagetools table autoresize collections gallery code paste media lists fullscreen stickytoolbar form hrreserve pagenews faq recordSearch map'
    ],
    menu: {
        custom: { title: 'Плагины', items: 'form gallery collections hrreserve pagenews faq recordSearch map'}
    },
    menubar: 'file edit view insert format tools table custom',
    contextmenu: "link image imagetools table spellchecker",
    toolbar: "code fullscreen | undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist blockquote | link image media",
    language: 'ru',
    extended_valid_elements : "faq[data-ids|data-category],map[data-id],searchrecord[data-encodedata],pagenews[data-id],hrreserve[pagesize],collection[data-id|data-encodedata],gallery[data-id|data-limit|data-type],forms[data-id|data-data]",
    content_css : "/js/tinymce/admin.css",
    image_title: true,
    images_upload_url: '/media/tinymce',
    automatic_uploads: true,
    paste_data_images: true,
    file_picker_types: 'file image',
    sticky_offset: 0,
    convert_urls: 0,
    /*file_picker_callback: function(callback, value, meta) {
        // Provide file and text for the link dialog
        if (meta.filetype == 'file') {
            filePicker(callback, value, meta);
        }
    },*/

    /*file_picker_callback : function (cb, value, meta) {
      var input = document.createElement('input');
      input.setAttribute('type', 'file');
      input.setAttribute('accept', 'image/*');
      input.onchange = function () {
        var file = this.files[0];

        var reader = new FileReader();
        reader.onload = function () {
          var id = 'blobid' + (new Date()).getTime();
          var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
          var base64 = reader.result.split(',')[1];
          var blobInfo = blobCache.create(id, file, base64);
          blobCache.add(blobInfo);
          cb(blobInfo.blobUri(), { title: file.name });
        };
        reader.readAsDataURL(file);
      };
      input.click();
    },*/
    formats: {
        removeformat: [
            {
                selector: 'b,strong,em,i,font,u,strike,sub,sup,dfn,code,samp,kbd,var,cite,mark,q,del,ins,blockquote',
                remove: 'all',
                split: true,
                block_expand: true,
                expand: false,
                deep: true
            },
            { selector: 'span', attributes: ['style', 'class'], remove: 'empty', split: true, expand: false, deep: true },
            { selector: '*', attributes: ['style', 'class'], split: false, expand: false, deep: true }
        ]
    }
};

function reordModels($block,$data)
{
  var ords = [];

  $block.children().each(function(i){
    if ($(this).data('key')!=undefined)
      ords.push($(this).data('key'));
    else
      ords.push($(this).data('id'));
  });

  if ($block.prop("tagName")=='TBODY')
    var url = $block.parent().data('order-url');
  else
    var url = $block.data('order-url');

  $.ajax({
      url: url,
      type: 'post',
      data: {ords: ords, _csrf: csrf_value},
      success: function(data)
      {
        toastr.success('Порядок изменен', '');
      }
  });
}

jQuery(document).ready(function()
{
    $(".table-hover tr").click(function(){
      $(".table-info").removeClass('table-info');
      $(this).addClass('table-info');
    });

    if (typeof logs !== 'undefined') {

       

      for(var k in logs) {
         

         if ($('#'+k).length>0)
         {
            $('#'+k).append('<i class="bx bxs-error-circle log-tooltip" title="'+logs[k]['date']+' '+logs[k]['user']+'"></i>');
         }
      }

      $('[data-toggle="tooltip"]').tooltip();
    }

    if ($("#violation-table, #monitoring-table").length>0)
    {
      $(".summary").prepend('<div class="btn-group"><a href="#" class="dropdown-toggle dropdown-toggle-split text-muted mx-4" data-toggle="dropdown" data-bs-toggle="dropdown">Настройки<span class="caret"></span></a><ul class="dropdown-menu" id="table-columns" data-popper-placement="bottom-start"></ul></div>');
      
      $(".table thead th").each(function(i){

          if (i>0)
          {
            let index = $(this).index();
            let id = $(this).attr('id');

            let checked = '';

            if (table_settings.indexOf(id)>=0 || table_settings.length==0)
              checked = 'checked';

            $("#table-columns").append('<li class="checkbox-row"><input '+checked+' type="checkbox" name="columns[]" value="'+id+'" id="toggle-column-'+index+'"> <label for="toggle-column-'+index+'">'+$(this).text()+'</label></li>');

            if (checked=='')
            {
              $("table tr").each(function(){
                  $(this).find("td:eq("+index+"),th:eq("+index+")").hide();
              });
            }
          }
      });

      $(".checkbox-row").click(function (e) {
        e.stopPropagation();
      });

      var old_index,new_index;

      var column_ajax_order = false;

      $("#table-columns").sortable({
          update: function(event, ui) {
            new_index  = ui.item.index()+1;

            $("table tr").each(function(){
                if (new_index>old_index)
                  $(this).find('td:eq('+old_index+'),th:eq('+old_index+')').insertAfter($(this).find("td:eq("+new_index+"),th:eq("+new_index+")"));
                else
                  $(this).find('td:eq('+old_index+'),th:eq('+old_index+')').insertBefore($(this).find("td:eq("+new_index+"),th:eq("+new_index+")"));
            });

             if (column_ajax_order)
              column_ajax_order.abort();

            var data = {columns:[],order:[],id:$(".table").attr('id')};
            
            $("#table-columns input").each(function (i) {
              data.order[i] = $(this).val();

              if ($(this).is(":checked"))
                data.columns.push($(this).val());
            });

            column_ajax_order = $.ajax({
                url: '/user/settings',
                type: 'post',
                data: data,
                success: function(data)
                {

                }
            });
          },
          start: function(event, ui) {
            old_index = ui.item.index()+1;
          }
      });

      var column_ajax = false;

      $(".checkbox-row input").change(function (e) {
            let show = $(this).is(":checked");
            let column_index = $(this).parent().index()+1;

            $("table tr").each(function(){
              if (show)
                $(this).find("td:eq("+column_index+"),th:eq("+column_index+")").show();
              else 
                $(this).find("td:eq("+column_index+"),th:eq("+column_index+")").hide();
            });

            if (column_ajax)
              column_ajax.abort();

            var data = [];

            column_ajax = $.ajax({
                url: '/user/settings',
                type: 'post',
                data: $("#table-columns input").serialize()+'&id='+$(".table").attr('id'),
                success: function(data)
                {

                }
            });
      });
    }


    $(".submit-button").click(function(e){
        $("#comment_decline").show().prop('required',false).focus();

        e.stopPropagation();
        return true;
    });

    $('#violation-goods_name').autocomplete({
            'minLength':0,
            'showAnim':'fold',
            'select': function(event, ui) {
                //rinput.val(ui.item['id']);
            },
            'source':'/help/goods'
    });


    $('#datepicker-map').datepicker({
        language: "ru",
        autoclose: true
    });

    $("#datepicker-map").change(function(){
      $("#map-form").submit();
    });

    $('#id_city').select2({
        minimumInputLength:0,
        ajax: {
          url: '/address/city',
          dataType: 'json',
          data: function (params) {
                var query = {
                  search: params.term,
                  id_region: $("#id_region").val()
                };

                return query;
              }
        }
    });

    $("select.select2").select2({
        minimumResultsForSearch:10
    });


    $("body").delegate('.dz-remove','click',function(){

        var form = $(this).closest('form');
        $(this).closest('.fileupload_item').remove();
        recalculateFormSize(form);
        return false;

    });

    $(".selectActionDropDown a").click(function(){

      var $link = $(this);
      if ($('input[name="selection[]"]:checked').length==0)
      {
          alert('Вы не выбрали ниодной записи');
      }
      else
      {
        var ids = [];

        $('input[name="selection[]"]:checked').each(function(i){
            ids.push($(this).val());
        });

        $.ajax({
            url: document.location,
            type: 'post',
            data: {ids:ids,action:$link.data('action')},
            success: function(data)
            {
              $.pjax.reload({container: '#collection_grid', async: false});
              //toastr.success('Готово', '');
            }
        });
      }

      return false;
    });




    csrf = $('meta[name=csrf-param]').prop('content');
    csrf_value = $('meta[name=csrf-token]').prop('content');

    $("body").delegate('.multiyiinput .close,.multiinput .close','click',function(){
      $(this).parent().parent().remove();
      return false;
    });

    $(".import-collection-start").change(function(){

    var $table = $(this).closest('.panel-body').find('table');

      if ($(this).val()>0)
      {
        $table.find('.disable').removeClass('disable');
        $table.find('tr').slice(0,$(this).val()).addClass('disable');
      }
      else
        $table.find('.disable').removeClass('disable');

    });

    if ($(".sortable").length>0)
    $(".sortable").sortable({
      stop: function(event, ui){
        $(this).find('.row').each(function(i){
            $(this).find("input[name*='ord]']").val($(this).index());
        });

          /*if ($(this).prop("tagName")=='TBODY')
            $this = $(this).parent();
          else
            $this = $(this);

          var id = ui.item.data('id');
          var pos = ui.item.index();
          var table = $this.data('table');
          var where = $this.data('where');
          var pk = $this.data('pk');
          if (table)
              $.ajax({
                  url: '/master/default/reord',
                  type: 'post',
                  data: 'id='+id+'&pos='+pos+'&table='+table+'&where='+where+'&pk='+pk,
                  success: function(data)
                  {
                  }f
              });*/
      }
    }).disableSelection();

    if ($(".ordered tbody, ul.ordered, div.ordered").length>0)
      $(".ordered tbody, ul.ordered, div.ordered").sortable({
        stop: function(event, ui){

            reordModels($(this));

            /*if ($(this).prop("tagName")=='TBODY')
              $this = $(this).parent();
            else
              $this = $(this);

            var id = ui.item.data('id');
            var pos = ui.item.index();
            var table = $this.data('table');
            var where = $this.data('where');
            var pk = $this.data('pk');

            if (table)
                $.ajax({
                    url: '/site/reord',
                    type: 'post',
                    data: 'id='+id+'&pos='+pos+'&table='+table+'&where='+where+'&pk='+pk,
                    success: function(data)
                    {

                    }
                });*/
        }
    }).disableSelection();
});