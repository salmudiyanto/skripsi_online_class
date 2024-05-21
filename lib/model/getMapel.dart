// To parse this JSON data, do
//
//     final getMapel = getMapelFromJson(jsonString);

import 'package:meta/meta.dart';
import 'dart:convert';

List<GetMapel> getMapelFromJson(String str) =>
    List<GetMapel>.from(json.decode(str).map((x) => GetMapel.fromJson(x)));

String getMapelToJson(List<GetMapel> data) =>
    json.encode(List<dynamic>.from(data.map((x) => x.toJson())));

class GetMapel {
  GetMapel({
    required this.id,
    required this.hari,
    required this.mapel,
    required this.kelas,
    required this.jampelajaran,
    required this.createdAt,
    required this.updatedAt,
    required this.idmapel,
    required this.namamapel,
    required this.idusersiswa,
    required this.iduser,
    required this.siswa,
    required this.namakelas,
    required this.idkelas,
  });

  int id;
  String hari;
  String mapel;
  String kelas;
  String jampelajaran;
  DateTime createdAt;
  DateTime updatedAt;
  int idmapel;
  String namamapel;
  String idusersiswa;
  int iduser;
  String siswa;
  String namakelas;
  int idkelas;

  factory GetMapel.fromJson(Map<String, dynamic> json) => GetMapel(
        id: json["id"],
        hari: json["hari"],
        mapel: json["mapel"],
        kelas: json["kelas"],
        jampelajaran: json["jampelajaran"],
        createdAt: DateTime.parse(json["created_at"]),
        updatedAt: DateTime.parse(json["updated_at"]),
        idmapel: json["idmapel"],
        namamapel: json["namamapel"],
        idusersiswa: json["idusersiswa"],
        iduser: json["iduser"],
        siswa: json["siswa"],
        namakelas: json["namakelas"],
        idkelas: json["idkelas"],
      );

  Map<String, dynamic> toJson() => {
        "id": id,
        "hari": hari,
        "mapel": mapel,
        "kelas": kelas,
        "jampelajaran": jampelajaran,
        "created_at": createdAt.toIso8601String(),
        "updated_at": updatedAt.toIso8601String(),
        "idmapel": idmapel,
        "namamapel": namamapel,
        "idusersiswa": idusersiswa,
        "iduser": iduser,
        "siswa": siswa,
        "namakelas": namakelas,
        "idkelas": idkelas,
      };
}
