import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:smpn2parepare/model/getJadwal.dart';

class MapelVM {
  Future getMapel(String id) async {
    try {
      http.Response hasil = await http.get(
          Uri.parse("http://smpn2parepare.balconteach.my.id/apimateri/$id"),
          headers: {"Accept": "application/json"});
      if (hasil.statusCode == 200) {
        print("data category success");
        print(hasil.body);
        final data = getJadwalFromJson(hasil.body);
        return data;
      } else {
        print("error status " + hasil.statusCode.toString());
        return null;
      }
    } catch (e) {
      print("error catch $e");
      return null;
    }
  }
}
