// To parse this JSON data, do
//
//     final getEssay = getEssayFromJson(jsonString);

import 'package:meta/meta.dart';
import 'dart:convert';

List<GetEssay> getEssayFromJson(String str) =>
    List<GetEssay>.from(json.decode(str).map((x) => GetEssay.fromJson(x)));

String getEssayToJson(List<GetEssay> data) =>
    json.encode(List<dynamic>.from(data.map((x) => x.toJson())));

class GetEssay {
  GetEssay({
    required this.id,
    required this.kelompokSoal,
    required this.soal,
    required this.urut,
    required this.bobot,
    required this.createdAt,
    required this.updatedAt,
  });

  int id;
  String kelompokSoal;
  String soal;
  String urut;
  String bobot;
  DateTime createdAt;
  DateTime updatedAt;

  factory GetEssay.fromJson(Map<String, dynamic> json) => GetEssay(
        id: json["id"],
        kelompokSoal: json["kelompok_soal"],
        soal: json["soal"],
        urut: json["urut"],
        bobot: json["bobot"],
        createdAt: DateTime.parse(json["created_at"]),
        updatedAt: DateTime.parse(json["updated_at"]),
      );

  Map<String, dynamic> toJson() => {
        "id": id,
        "kelompok_soal": kelompokSoal,
        "soal": soal,
        "urut": urut,
        "bobot": bobot,
        "created_at": createdAt.toIso8601String(),
        "updated_at": updatedAt.toIso8601String(),
      };
}
