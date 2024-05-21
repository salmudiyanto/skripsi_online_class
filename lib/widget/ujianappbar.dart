import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

AppBar ujianAppbar(BuildContext context, String judulHal) {
  final isDarkMode = Theme.of(context).brightness == Brightness.dark;
  final icon = CupertinoIcons.moon_stars;

  return AppBar(
    leading: const BackButton(),
    title: Text(judulHal),
    elevation: 0,
    actions: [IconButton(onPressed: () {}, icon: const Icon(Icons.message))],
  );
}

// AppBar(
//         title: Text("Mekanik"),
//         actions: [
//           IconButton(onPressed: () {}, icon: const Icon(Icons.message))
//         ],
//       )
