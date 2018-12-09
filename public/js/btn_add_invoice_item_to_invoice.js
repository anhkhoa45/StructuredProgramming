function ajax(element){
    var id = element.value;
    var $this = $(element);

    $.ajax({type: 'GET',
        url: 'http://localhost:8000/ajax/product/search/'+id,
        dataType: 'json',
        success: function(result){
            $this.css("background","");
            $.each(result, function(index, element) {
                if(index=='status'){
                    if(element=='notfound'){
                        $this.css("background","red");
                        return ;
                    }
                }

            });

            $.each(result, function(index, element) {
                if(index=='image'){
                    $this.parent().next().next().next().children().eq(0).attr("src","http://localhost:8000/storage/products/"+element);
                }
                if(index=='name'){
                    $this.parent().next().children().eq(0).text(element);
                }

            });

        }
    });
}
$(function () {$("#btn_add_new_invoice_item").on( "click", function() {
    var markup = '<tr>\n' +
        '                                            <td>\n' +
        '                                                </td>\n' +
        '                                            <td><input type="text" class="id_product_input form-control" onchange="ajax(this);" name="new_product_id[]" style="width:100px"\\n\' +\n' +
        '        \'                                                    /></td><td><div ></div>\n' +
    '                                                </td>\n' +
        '                                            <td><input type="text" value = "" class="form-control"  name="new_quantities[]">\n' +
        '                                                       </td><td><img  style="width:150px" /></td> <td></td>\n' +
        '                                        </tr>';

       $('#invoice_item_table').append(markup);

    });
});

