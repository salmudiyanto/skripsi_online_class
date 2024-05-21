import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:smpn2parepare/const.dart';
import 'package:smpn2parepare/model/getJadwal.dart';
import 'package:smpn2parepare/model/getSoal.dart';

class SoalVM {
  Future getSoal(String id) async {
    try {
      http.Response hasil = await http.get(
          Uri.parse("${VariableAPK.url}apisoal/$id"),
          headers: {"Accept": "application/json"});
      if (hasil.statusCode == 200) {
        print("data category success");
        print(hasil.body);
        final data = getSoalFromJson(hasil.body);
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
