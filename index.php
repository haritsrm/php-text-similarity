<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            body{background: gainsboro;}
            .tabel-input{margin:0 auto;}
            #info{text-align: center; margin-top: 20px;}
            #info p{font-size: 1.3em; font-weight: bold; color: gray}
            .center{text-align: center;}
            .center .text {width: 99%; height: 400px;}
            .button {width: 100px;height: 40px; background: cornflowerblue; color: #fff; cursor: pointer; border-radius: 5px; font-weight: bold}
            .button:hover{opacity: 0.8;}
            .kalimat1 {background: cornflowerblue;}
            .kalimat2 {background: cornflowerblue;}
            .kalimat1, .kalimat2{color: #eee;}
            .ta1:hover{border-color: cornflowerblue;}
            .ta2:hover{border-color: cornflowerblue;}
            .logo {position: absolute; z-index: 1; left: 620px; top: 250px; margin: 0 auto;}
            .logo img{width: 100px; opacity: 0.5;}
            #display_count1, #display_count2, #info1, #info2, .gray{color: gray; font-weight: bold;}
        </style>
        <script src="jquery-3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <form id="formInput">
            <table border="0" width="90%" class="tabel-input">
                <!-- <div class="logo"><img src=""></div> -->
                <tr>
                    <td class="center kalimat1"><h3>Kalimat Pertama (Artikel Asli)</h3></td>
                    <td class="center kalimat2"><h3>Kalimat Kedua (Artikel Baru)</h3></td>
                </tr>
                <tr>
                    <td class="center"><textarea class="text ta1" name="ta1" placeholder="ketikkan satu atau lebih kalimat.."></textarea></td>
                    <td class="center"><textarea class="text ta2" name="ta2" placeholder="ketikkan satu atau lebih kalimat.."></textarea></td>
                </tr>
                <tr>
                    <td class="center gray"> Total Kata : <span id="display_count1">0</span> kata. 
                        <div id="info1">Tidak ada masukan</span></div></td>
                    <td class="center gray"> Total Kata : <span id="display_count2">0</span> kata. 
                        <div id="info2">Tidak ada masukan</span></div></td>
                </tr>
                <tr>
                    <td colspan="2" class="center">
                        <input type="button" name="process" id="process" class="button" value="Proses">
                    </td>
                </tr>
            </table>
            <div id="info"><p>Hasil kemiripan kalimat akan muncul setelah anda mengisi kolom diatas</p></div>
        </form>
        <script>
            $(".ta1").on('keydown', function (e) {
                var words = $.trim(this.value).length ? this.value.match(/\S+/g).length : 0;
                if (words == 0) {
                    $('#display_count1').text(words);
                    $('#info1').text('Tidak ada info').css('color', '');
                } else if (words <= 300) {
                    $('#display_count1').text(words);
                    $('#info1').text('Masih Kurang ke 300 kata').css('color', 'red');
                } else {
                    $('#display_count1').text(words);
                    $('#info1').text('Telah Mencapai 300 kata').css('color', 'green');
                }
            });
            $(".ta2").on('keydown', function (e) {
                var words = $.trim(this.value).length ? this.value.match(/\S+/g).length : 0;
                if (words == 0) {
                    $('#display_count2').text(words);
                    $('#info2').text('Tidak ada masukan').css('color', '');
                } else if (words <= 300) {
                    $('#display_count2').text(words);
                    $('#info2').text('Masih Kurang ke 300 kata').css('color', 'red');
                } else {
                    $('#display_count2').text(words);
                    $('#info2').text('Telah Mencapai 300 kata').css('color', 'green');
                }
            });
            $('#process').click(function (e) {
                e.preventDefault();
                var kalimat1 = $('.ta1').val();
                var kalimat2 = $('.ta2').val();
                if (kalimat1 == '') {
                    $('#info').html('<p>Kalimat pertama tidak boleh kosong!!</p>');
                }else if (kalimat2 == '') {
                    $('#info').html('<p>Kalimat kedua tidak boleh kosong!!</p>');
                } else {
                    $.ajax({
                        type: "POST",
                        url: "action.php",
                        data: $("#formInput").serialize(), // serializes the form's elements.
                        success: function (data)
                        {
                            //console.log(data);
                            $('#info').html(data);
                        }
                    });
                }
            });
        </script>
    </body>
</html>
