// To parse this JSON data, do
//
//     final getTugas = getTugasFromJson(jsonString);

import 'package:meta/meta.dart';
import 'dart:convert';

List<GetTugas> getTugasFromJson(String str) =>
    List<GetTugas>.from(json.decode(str).map((x) => GetTugas.fromJson(x)));

String getTugasToJson(List<GetTugas> data) =>
    json.encode(List<dynamic>.from(data.map((x) => x.toJson())));

class GetTugas {
  GetTugas({
    required this.id,
    required this.mapel,
    required this.urut,
    required this.siswa,
    required this.nilai,
    required this.mulai,
    required this.deskripsi,
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
  DateTime mulai;
  String deskripsi;
  DateTime selesai;
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

  factory GetTugas.fromJson(Map<String, dynamic> json) => GetTugas(
        id: json["id"],
        mapel: json["mapel"],
        urut: json["urut"],
        siswa: json["siswa"],
        nilai: json["nilai"],
        mulai: DateTime.parse(json["mulai"]),
        deskripsi: json["deskripsi"],
        selesai: DateTime.parse(json["selesai"]),
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
        "mulai": mulai.toIso8601String(),
        "deskripsi": deskripsi,
        "selesai": selesai.toIso8601String(),
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
