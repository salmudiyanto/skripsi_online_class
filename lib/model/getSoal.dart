// To parse this JSON data, do
//
//     final getSoal = getSoalFromJson(jsonString);

import 'package:meta/meta.dart';
import 'dart:convert';

List<GetSoal> getSoalFromJson(String str) =>
    List<GetSoal>.from(json.decode(str).map((x) => GetSoal.fromJson(x)));

String getSoalToJson(List<GetSoal> data) =>
    json.encode(List<dynamic>.from(data.map((x) => x.toJson())));

class GetSoal {
  GetSoal({
    required this.id,
    required this.kelompoksoal,
    required this.urut,
    required this.soal,
    required this.a,
    required this.b,
    required this.c,
    required this.d,
    required this.jawabanBenar,
    required this.createdAt,
    required this.updatedAt,
  });

  int id;
  String kelompoksoal;
  String urut;
  String soal;
  String a;
  String b;
  String c;
  String d;
  String jawabanBenar;
  DateTime createdAt;
  DateTime updatedAt;

  factory GetSoal.fromJson(Map<String, dynamic> json) => GetSoal(
        id: json["id"],
        kelompoksoal: json["kelompoksoal"],
        urut: json["urut"],
        soal: json["soal"],
        a: json["a"],
        b: json["b"],
        c: json["c"],
        d: json["d"],
        jawabanBenar: json["jawaban_benar"],
        createdAt: DateTime.parse(json["created_at"]),
        updatedAt: DateTime.parse(json["updated_at"]),
      );

  Map<String, dynamic> toJson() => {
        "id": id,
        "kelompoksoal": kelompoksoal,
        "urut": urut,
        "soal": soal,
        "a": a,
        "b": b,
        "c": c,
        "d": d,
        "jawaban_benar": jawabanBenar,
        "created_at": createdAt.toIso8601String(),
        "updated_at": updatedAt.toIso8601String(),
      };
}
