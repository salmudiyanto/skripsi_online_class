// To parse this JSON data, do
//
//     final getMateri = getMateriFromJson(jsonString);

import 'package:meta/meta.dart';
import 'dart:convert';

List<GetMateri> getMateriFromJson(String str) =>
    List<GetMateri>.from(json.decode(str).map((x) => GetMateri.fromJson(x)));

String getMateriToJson(List<GetMateri> data) =>
    json.encode(List<dynamic>.from(data.map((x) => x.toJson())));

class GetMateri {
  GetMateri({
    required this.idmateri,
    required this.judul,
    required this.mapel,
    required this.urut,
    required this.tingkat,
    required this.tahunajaran,
    required this.deskripsi,
    required this.file,
    required this.id,
    required this.guru,
    required this.namaMapel,
  });

  int idmateri;
  String judul;
  String mapel;
  String urut;
  String tingkat;
  int tahunajaran;
  String deskripsi;
  String file;
  int id;
  String guru;
  String namaMapel;

  factory GetMateri.fromJson(Map<String, dynamic> json) => GetMateri(
        idmateri: json["idmateri"],
        judul: json["judul"],
        mapel: json["mapel"],
        urut: json["urut"],
        tingkat: json["tingkat"],
        tahunajaran: json["tahunajaran"],
        deskripsi: json["deskripsi"],
        file: json["file"],
        id: json["id"],
        guru: json["guru"],
        namaMapel: json["nama_mapel"],
      );

  Map<String, dynamic> toJson() => {
        "idmateri": idmateri,
        "judul": judul,
        "mapel": mapel,
        "urut": urut,
        "tingkat": tingkat,
        "tahunajaran": tahunajaran,
        "deskripsi": deskripsi,
        "file": file,
        "id": id,
        "guru": guru,
        "nama_mapel": namaMapel,
      };
}
