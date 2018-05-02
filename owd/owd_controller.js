$(document).ready(function() {
  $("#btn_w").click(function() {
    $.getJSON("http://api.openweathermap.org/data/2.5/weather?q=" + $("#loc_w").val() +"&units=metric&APPID=0db4f6f3a26e4ddedebc688d8a5a1f5e", function(result) {
      if(result) {
        $("#w_date").empty().append('<h6>' + new Date() + '</h6>');
        $("#w_body").empty().append($('<h5>' + result['name'] +', <strong>' + result['sys'].country + '</strong> (lon=' + result['coord'].lon + ', lat=' + result['coord'].lat + ')</h5>'));
        var table = $('<table class="w3-table w3-striped"><tbody></tbody></table>');
        table.append($('<tr><td>main</td><td>'+ result['weather'][0].main +'</td></tr>'));
        table.append($('<tr><td>description</td><td>'+ result['weather'][0].description +'</td></tr>'));
        table.append($('<tr><td>temp</td><td>'+ (result['main'].temp).toFixed(1) +' °C</td></tr>'));
        table.append($('<tr><td>pressure</td><td>'+ result['main'].pressure +' hPa</td></tr>'));
        table.append($('<tr><td>humidity</td><td>'+ result['main'].humidity +'%</td></tr>'));
        table.append($('<tr><td>wind speed</td><td>'+ result['wind'].speed +' m/s</td></tr>'));
        table.append($('<tr><td>wind deg</td><td>'+ result['wind'].deg +'</td></tr>'));
        table.append($('<tr><td>visibility</td><td>'+ result['visibility'] +'</td></tr>'));
        $("#w_body").append(table);
      }
    });
  });
  $("#btn_f").click(function() {
    $("#f_body").empty();
    $.getJSON("http://api.openweathermap.org/data/2.5/forecast?q=" + $("#loc_f").val() +"&units=metric&APPID=0db4f6f3a26e4ddedebc688d8a5a1f5e", function(result) {
      if(result) {
        $("#f_body").empty().append($('<h5>' + result['city'].name +', <strong>' + result['city'].country + '</strong> (lon=' + result['city'].coord.lon + ', lat=' + result['city'].coord.lat + ')</h5>'));
        var select = $('<select id="dates" class="w3-select w3-border" style="width: 30%;"></select>');
        $.each(result['list'], function(k, v) {
          var option = $('<option value="'+ k +'">' + v['dt_txt'] + '</option>');
          select.append(option);
        });
        $("#f_body").append('<strong>Select a date/time: </strong>');
        $("#f_body").append(select);
        $('#f_body').append('<div id="f_tab" class="w3-container"></div>')
        $("#f_tab").empty().append(fill(0, result));
        
        $("#dates").on("change", function() {
          $("#f_tab").empty().append(fill($(this).val(), result));
        });
      }
    });
  });
  $("#btn_w_canc").click(function() {
    cancel($("#w_body"), $("#loc_w"));
    $("#w_date").empty();
  });
  $("#btn_f_canc").click(function() {
    cancel($("#f_body"), $("#loc_f"));
  });
});

function fill(index, result) {
  var table = $('<table class="w3-table w3-striped"><tbody></tbody></table>');
  table.append($('<tr><td>main</td><td>'+ result['list'][index].weather[0].main +'</td></tr>'));
  table.append($('<tr><td>description</td><td>'+ result['list'][index].weather[0].description +'</td></tr>'));
  table.append($('<tr><td>temp</td><td>'+ (result['list'][index].main.temp).toFixed(1) +' °C</td></tr>'));
  table.append($('<tr><td>pressure</td><td>'+ result['list'][index].main.pressure +' hPa</td></tr>'));
  table.append($('<tr><td>humidity</td><td>'+ result['list'][index].main.humidity +'%</td></tr>'));
  table.append($('<tr><td>wind speed</td><td>'+ result['list'][index].wind.speed +' m/s</td></tr>'));
  table.append($('<tr><td>wind deg</td><td>'+ result['list'][index].wind.deg +'</td></tr>'));
  return table;
}

function cancel(div, text) {
  $(div).empty();
  $(text).val("");
}