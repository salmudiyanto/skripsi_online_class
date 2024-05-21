import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:flutter_barcode_scanner/flutter_barcode_scanner.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:gap/gap.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:smpn2parepare/const.dart';
import 'package:smpn2parepare/page/test.dart';
import 'package:smpn2parepare/viewmodel/vm_mapel.dart';
import 'package:smpn2parepare/widget/customCard.dart';
import 'package:flutter_staggered_grid_view/flutter_staggered_grid_view.dart';
import 'package:smpn2parepare/widget/layout.dart';
import 'package:smpn2parepare/widget/style.dart';
import 'package:http/http.dart' as http;

class Dashboard extends StatefulWidget {
  const Dashboard({super.key});

  @override
  State<Dashboard> createState() => DashboardState();
}

class DashboardState extends State<Dashboard> {
  bool load = true;
  String nama = '';
  int idSiswa = 0;
  late int jmlMateri, jmlTugas, jmlKuis, jmlUjian;
  Future ceklogin() async {
    final prefs = await SharedPreferences.getInstance();
    if (prefs.getBool('LoginSiswa') == true) {
      setState(() {
        nama = prefs.getString('namaSiswa')!;
        idSiswa = prefs.getInt('idSiswa')!;
      });
    }
  }

  ambilDashboard() async {
    final http.Response response = await http.get(
        Uri.parse("${VariableAPK.url}dashboard/$idSiswa"),
        headers: {"Accept": "application/json"});
    final data = jsonDecode(response.body);
    if (response.statusCode == 200) {
      setState(() {
        jmlMateri = data['materi'];
        jmlTugas = data['tugas'];
        jmlKuis = data['kuis'];
        jmlUjian = data['ujian'];
        load = false;
      });
    } else {
      setState(() {
        jmlMateri = -1;
        jmlTugas = -1;
        jmlKuis = -1;
        jmlUjian = -1;
        load = false;
      });
    }
  }

  @override
  void initState() {
    ceklogin().whenComplete(() => ambilDashboard());

    // TODO: implement initState
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    final size = AppLayout.getSize(context);

    return load
        ? Center(
            child: CircularProgressIndicator(
              color: Colors.amber,
            ),
          )
        : Container(
            decoration: const BoxDecoration(
                // color: Colors.red.withOpacity(0.1),
                image: DecorationImage(
                    image: AssetImage("assets/bg.jpg"),
                    fit: BoxFit.cover,
                    opacity: 0.3)),
            child: Padding(
              padding:
                  const EdgeInsets.symmetric(horizontal: 30.0, vertical: 30.0),
              child: ListView(
                scrollDirection: Axis.vertical,
                children: [
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            'Hi, $nama',
                            style: TextStyle(
                              fontSize: 22,
                            ),
                          ),
                          SizedBox(
                            height: 8,
                          ),
                          Text(
                            'Selamat Datang.',
                            style: TextStyle(
                              fontSize: 24,
                              fontWeight: FontWeight.bold,
                            ),
                          ),
                        ],
                      ),
                    ],
                  ),
                  const SizedBox(
                    height: 30,
                  ),
                  Row(
                    children: [
                      InkWell(
                        onTap: () {},
                        child: Container(
                          width: size.width * .37,
                          height: AppLayout.getHeight(100),
                          decoration: BoxDecoration(
                              color: VariableAPK.primaryColor,
                              borderRadius: BorderRadius.circular(
                                  AppLayout.getHeight(18))),
                          padding: EdgeInsets.symmetric(
                              vertical: AppLayout.getHeight(15),
                              horizontal: AppLayout.getWidth(15)),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Text(
                                "Materi",
                                style: Styles.headLineStyle2.copyWith(
                                    fontWeight: FontWeight.bold,
                                    color: Colors.white),
                              ),
                              Gap(AppLayout.getHeight(10)),
                              Text(
                                "sebanyak $jmlMateri item",
                                style: Styles.headLineStyle2.copyWith(
                                    fontWeight: FontWeight.w600,
                                    color: Colors.white,
                                    fontSize: 12),
                              )
                            ],
                          ),
                        ),
                      ),
                      SizedBox(
                        width: 10,
                      ),
                      InkWell(
                        onTap: () {},
                        child: Container(
                          width: size.width * .37,
                          height: AppLayout.getHeight(100),
                          decoration: BoxDecoration(
                              color: VariableAPK.primaryColor,
                              borderRadius: BorderRadius.circular(
                                  AppLayout.getHeight(18))),
                          padding: EdgeInsets.symmetric(
                              vertical: AppLayout.getHeight(15),
                              horizontal: AppLayout.getWidth(15)),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Text(
                                "Tugas",
                                style: Styles.headLineStyle2.copyWith(
                                    fontWeight: FontWeight.bold,
                                    color: Colors.white),
                              ),
                              Gap(AppLayout.getHeight(10)),
                              Text(
                                "sebanyak $jmlTugas item",
                                style: Styles.headLineStyle2.copyWith(
                                    fontWeight: FontWeight.w600,
                                    color: Colors.white,
                                    fontSize: 12),
                              )
                            ],
                          ),
                        ),
                      ),
                    ],
                  ),
                  SizedBox(
                    height: 10,
                  ),
                  Row(
                    children: [
                      InkWell(
                        onTap: () {},
                        child: Container(
                          width: size.width * .37,
                          height: AppLayout.getHeight(100),
                          decoration: BoxDecoration(
                              color: VariableAPK.primaryColor,
                              borderRadius: BorderRadius.circular(
                                  AppLayout.getHeight(18))),
                          padding: EdgeInsets.symmetric(
                              vertical: AppLayout.getHeight(15),
                              horizontal: AppLayout.getWidth(15)),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Text(
                                "Kuis",
                                style: Styles.headLineStyle2.copyWith(
                                    fontWeight: FontWeight.bold,
                                    color: Colors.white),
                              ),
                              Gap(AppLayout.getHeight(10)),
                              Text(
                                "sebanyak $jmlKuis item",
                                style: Styles.headLineStyle2.copyWith(
                                    fontWeight: FontWeight.w600,
                                    color: Colors.white,
                                    fontSize: 12),
                              )
                            ],
                          ),
                        ),
                      ),
                      SizedBox(
                        width: 10,
                      ),
                      InkWell(
                        onTap: () {},
                        child: Container(
                          width: size.width * .37,
                          height: AppLayout.getHeight(100),
                          decoration: BoxDecoration(
                              color: VariableAPK.primaryColor,
                              borderRadius: BorderRadius.circular(
                                  AppLayout.getHeight(18))),
                          padding: EdgeInsets.symmetric(
                              vertical: AppLayout.getHeight(15),
                              horizontal: AppLayout.getWidth(15)),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Text(
                                "Ujian",
                                style: Styles.headLineStyle2.copyWith(
                                    fontWeight: FontWeight.bold,
                                    color: Colors.white),
                              ),
                              Gap(AppLayout.getHeight(10)),
                              Text(
                                "sebanyak $jmlUjian item",
                                style: Styles.headLineStyle2.copyWith(
                                    fontWeight: FontWeight.w600,
                                    color: Colors.white,
                                    fontSize: 12),
                              )
                            ],
                          ),
                        ),
                      ),
                    ],
                  )
                ],
              ),
            ),
          );
  }
}

Widget courseLayout(BuildContext context) {
  List<String> imageFileList = [
    'bg.jpg',
    'bg.jpg',
    'bg.jpg',
    'bg.jpg',
  ];

  return MasonryGridView.count(
    shrinkWrap: true,
    physics: const NeverScrollableScrollPhysics(),
    crossAxisCount: 2,
    mainAxisSpacing: 27,
    crossAxisSpacing: 23,
    itemCount: imageFileList.length,
    itemBuilder: (context, index) {
      return ClipRRect(
        borderRadius: BorderRadius.circular(12),
        child: Image.asset(
          'assets/${imageFileList[index]}',
        ),
      );
    },
  );
}
