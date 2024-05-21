// To parse this JSON data, do
//
//     final getKuis = getKuisFromJson(jsonString);

import 'package:meta/meta.dart';
import 'dart:convert';

List<GetKuis> getKuisFromJson(String str) =>
    List<GetKuis>.from(json.decode(str).map((x) => GetKuis.fromJson(x)));

String getKuisToJson(List<GetKuis> data) =>
    json.encode(List<dynamic>.from(data.map((x) => x.toJson())));

class GetKuis {
  GetKuis({
    required this.id,
    required this.mapel,
    required this.urut,
    required this.siswa,
    required this.nilai,
    required this.deskripsi,
    required this.mulai,
    required this.selesai,
    required this.file,
    required this.stat,
    required this.createdAt,
    required this.updatedAt,
    required this.idUser,
    required this.kelas,
    required this.agama,
    required this.jenisKelamin,
    required this.alamat,
    required this.namasiswa,
    required this.guru,
    required this.namaMapel,
  });

  int id;
  String mapel;
  String urut;
  String siswa;
  int nilai;
  String deskripsi;
  String mulai;
  String selesai;
  String file;
  String stat;
  DateTime createdAt;
  DateTime updatedAt;
  String idUser;
  String kelas;
  String agama;
  String jenisKelamin;
  String alamat;
  String namasiswa;
  String guru;
  String namaMapel;

  factory GetKuis.fromJson(Map<String, dynamic> json) => GetKuis(
        id: json["id"],
        mapel: json["mapel"],
        urut: json["urut"],
        siswa: json["siswa"],
        nilai: json["nilai"],
        deskripsi: json["deskripsi"],
        mulai: json["mulai"],
        selesai: json["selesai"],
        file: json["file"],
        stat: json["stat"],
        createdAt: DateTime.parse(json["created_at"]),
        updatedAt: DateTime.parse(json["updated_at"]),
        idUser: json["id_user"],
        kelas: json["kelas"],
        agama: json["agama"],
        jenisKelamin: json["jenis_kelamin"],
        alamat: json["alamat"],
        namasiswa: json["namasiswa"],
        guru: json["guru"],
        namaMapel: json["nama_mapel"],
      );

  Map<String, dynamic> toJson() => {
        "id": id,
        "mapel": mapel,
        "urut": urut,
        "siswa": siswa,
        "nilai": nilai,
        "deskripsi": deskripsi,
        "mulai": mulai,
        "selesai": selesai,
        "file": file,
        "stat": stat,
        "created_at": createdAt.toIso8601String(),
        "updated_at": updatedAt.toIso8601String(),
        "id_user": idUser,
        "kelas": kelas,
        "agama": agama,
        "jenis_kelamin": jenisKelamin,
        "alamat": alamat,
        "namasiswa": namasiswa,
        "guru": guru,
        "nama_mapel": namaMapel,
      };
}
