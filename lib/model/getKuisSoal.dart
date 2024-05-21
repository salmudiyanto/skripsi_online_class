// To parse this JSON data, do
//
//     final getSoalKuis = getSoalKuisFromJson(jsonString);

import 'package:meta/meta.dart';
import 'dart:convert';

List<GetSoalKuis> getSoalKuisFromJson(String str) => List<GetSoalKuis>.from(
    json.decode(str).map((x) => GetSoalKuis.fromJson(x)));

String getSoalKuisToJson(List<GetSoalKuis> data) =>
    json.encode(List<dynamic>.from(data.map((x) => x.toJson())));

class GetSoalKuis {
  GetSoalKuis({
    required this.id,
    required this.mapel,
    required this.urut,
    required this.siswa,
    required this.nilai,
    required this.deskripsi,
    required this.mulai,
    required this.selesai,
    required this.file,
    required this.jawab,
    required this.stat,
    required this.createdAt,
    required this.updatedAt,
    required this.idKuis,
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
  String jawab;
  String stat;
  String createdAt;
  DateTime updatedAt;
  int idKuis;
  String idUser;
  String kelas;
  String agama;
  String jenisKelamin;
  String alamat;
  String namasiswa;
  String guru;
  String namaMapel;

  factory GetSoalKuis.fromJson(Map<String, dynamic> json) => GetSoalKuis(
        id: json["id"],
        mapel: json["mapel"],
        urut: json["urut"],
        siswa: json["siswa"],
        nilai: json["nilai"],
        deskripsi: json["deskripsi"],
        mulai: json["mulai"],
        selesai: json["selesai"],
        file: json["file"],
        jawab: json["jawab"],
        stat: json["stat"],
        createdAt: json["created_at"],
        updatedAt: DateTime.parse(json["updated_at"]),
        idKuis: json["idKuis"],
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
        "jawab": jawab,
        "stat": stat,
        "created_at": createdAt,
        "updated_at": updatedAt.toIso8601String(),
        "idKuis": idKuis,
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
