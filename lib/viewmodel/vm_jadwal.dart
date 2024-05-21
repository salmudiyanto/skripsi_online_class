import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:smpn2parepare/const.dart';
import 'package:smpn2parepare/model/getJadwal.dart';

class JadwalVM {
  Future getJadwal(String id) async {
    try {
      print("${VariableAPK.url}apijadwalsiswa/$id");
      http.Response hasil = await http.get(
          Uri.parse("${VariableAPK.url}apijadwalsiswa/$id"),
          headers: {"Accept": "application/json"});
      if (hasil.statusCode == 200) {
        print("data category success");
        print(hasil.body);
        final data = getJadwalFromJson(hasil.body);
        return data;
      } else {
        print("error statuss " + hasil.statusCode.toString());
        return null;
      }
    } catch (e) {
      print("error catch $e");
      return null;
    }
  }
}
