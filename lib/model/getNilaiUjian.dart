// To parse this JSON data, do
//
//     final getNilaiUjian = getNilaiUjianFromJson(jsonString);

import 'package:meta/meta.dart';
import 'dart:convert';

List<GetNilaiUjian> getNilaiUjianFromJson(String str) =>
    List<GetNilaiUjian>.from(
        json.decode(str).map((x) => GetNilaiUjian.fromJson(x)));

String getNilaiUjianToJson(List<GetNilaiUjian> data) =>
    json.encode(List<dynamic>.from(data.map((x) => x.toJson())));

class GetNilaiUjian {
  GetNilaiUjian({
    required this.id,
    required this.siswa,
    required this.idSoal,
    required this.namamapel,
    required this.namasiswa,
    required this.pilihangandanilai,
    required this.jawabessay,
    required this.bobothitung,
    required this.nilaiessay,
    required this.nilaitot,
  });

  int id;
  String siswa;
  String idSoal;
  String namamapel;
  String namasiswa;
  double pilihangandanilai;
  List<Jawabessay> jawabessay;
  double bobothitung;
  double nilaiessay;
  double nilaitot;

  factory GetNilaiUjian.fromJson(Map<String, dynamic> json) => GetNilaiUjian(
        id: json["id"],
        siswa: json["siswa"],
        idSoal: json["id_soal"],
        namamapel: json["namamapel"],
        namasiswa: json["namasiswa"],
        pilihangandanilai: json["pilihangandanilai"]?.toDouble(),
        jawabessay: List<Jawabessay>.from(
            json["jawabessay"].map((x) => Jawabessay.fromJson(x))),
        bobothitung: json["bobothitung"]?.toDouble(),
        nilaiessay: json["nilaiessay"]?.toDouble(),
        nilaitot: json["nilaitot"]?.toDouble(),
      );

  Map<String, dynamic> toJson() => {
        "id": id,
        "siswa": siswa,
        "id_soal": idSoal,
        "namamapel": namamapel,
        "namasiswa": namasiswa,
        "pilihangandanilai": pilihangandanilai,
        "jawabessay": List<dynamic>.from(jawabessay.map((x) => x.toJson())),
        "bobothitung": bobothitung,
        "nilaiessay": nilaiessay,
        "nilaitot": nilaitot,
      };
}

class Jawabessay {
  Jawabessay({
    required this.id,
    required this.idSoal,
    required this.siswa,
    required this.jawaban,
    required this.nilaiJawaban,
    required this.createdAt,
    required this.updatedAt,
    required this.kelompokSoal,
    required this.soal,
    required this.urut,
    required this.bobot,
  });

  int id;
  String idSoal;
  String siswa;
  String jawaban;
  double nilaiJawaban;
  DateTime createdAt;
  DateTime updatedAt;
  String kelompokSoal;
  String soal;
  String urut;
  String bobot;

  factory Jawabessay.fromJson(Map<String, dynamic> json) => Jawabessay(
        id: json["id"],
        idSoal: json["id_soal"],
        siswa: json["siswa"],
        jawaban: json["jawaban"],
        nilaiJawaban: json["nilai_jawaban"]?.toDouble(),
        createdAt: DateTime.parse(json["created_at"]),
        updatedAt: DateTime.parse(json["updated_at"]),
        kelompokSoal: json["kelompok_soal"],
        soal: json["soal"],
        urut: json["urut"],
        bobot: json["bobot"],
      );

  Map<String, dynamic> toJson() => {
        "id": id,
        "id_soal": idSoal,
        "siswa": siswa,
        "jawaban": jawaban,
        "nilai_jawaban": nilaiJawaban,
        "created_at": createdAt.toIso8601String(),
        "updated_at": updatedAt.toIso8601String(),
        "kelompok_soal": kelompokSoal,
        "soal": soal,
        "urut": urut,
        "bobot": bobot,
      };
}
