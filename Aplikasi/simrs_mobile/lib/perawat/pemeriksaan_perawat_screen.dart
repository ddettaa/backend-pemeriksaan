import 'package:flutter/material.dart';

void main() {
  runApp(
    const MaterialApp(
      home: PemeriksaanPerawat(),
      debugShowCheckedModeBanner: false,
    ),
  );
}

class PemeriksaanPerawat extends StatelessWidget {
  const PemeriksaanPerawat({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    final border = OutlineInputBorder(
      borderRadius: BorderRadius.circular(12),
      borderSide: const BorderSide(color: Colors.grey),
    );

    return Scaffold(
      appBar: AppBar(
        backgroundColor: Colors.white,
        elevation: 0,
        automaticallyImplyLeading: false,
        title: const Text(
          'DATA PASIEN',
          style: TextStyle(
            fontWeight: FontWeight.bold,
            color: Colors.black,
            fontSize: 16,
          ),
        ),
      ),
      body: Padding(
        padding: const EdgeInsets.all(16),
        child: ListView(
          children: [
            // No Reg
            const Text("No Reg"),
            const SizedBox(height: 4),
            TextField(
              decoration: InputDecoration(
                hintText: '4574538',
                border: border,
                enabledBorder: border,
                focusedBorder: border,
                contentPadding: const EdgeInsets.symmetric(horizontal: 12),
              ),
            ),
            const SizedBox(height: 16),

            // Nama
            const Text("Nama"),
            const SizedBox(height: 4),
            TextField(
              decoration: InputDecoration(
                hintText: 'Noer Putri',
                border: border,
                enabledBorder: border,
                focusedBorder: border,
                contentPadding: const EdgeInsets.symmetric(horizontal: 12),
              ),
            ),
            const SizedBox(height: 16),

            // Suhu
            const Text("Suhu"),
            const SizedBox(height: 4),
            TextField(
              decoration: InputDecoration(
                border: border,
                enabledBorder: border,
                focusedBorder: border,
                contentPadding: const EdgeInsets.symmetric(horizontal: 12),
              ),
            ),
            const SizedBox(height: 16),

            // Tensi
            const Text("Tensi"),
            const SizedBox(height: 4),
            TextField(
              decoration: InputDecoration(
                border: border,
                enabledBorder: border,
                focusedBorder: border,
                contentPadding: const EdgeInsets.symmetric(horizontal: 12),
              ),
            ),
            const SizedBox(height: 16),

            // Berat Badan
            const Text("Berat Badan"),
            const SizedBox(height: 4),
            TextField(
              decoration: InputDecoration(
                border: border,
                enabledBorder: border,
                focusedBorder: border,
                contentPadding: const EdgeInsets.symmetric(horizontal: 12),
              ),
            ),
            const SizedBox(height: 16),

            // Tinggi Badan
            const Text("Tinggi Badan"),
            const SizedBox(height: 4),
            TextField(
              decoration: InputDecoration(
                border: border,
                enabledBorder: border,
                focusedBorder: border,
                contentPadding: const EdgeInsets.symmetric(horizontal: 12),
              ),
            ),
            const SizedBox(height: 16),

            // Keluhan
            const Text("Keluhan"),
            const SizedBox(height: 4),
            TextField(
              maxLines: 3,
              decoration: InputDecoration(
                border: border,
                enabledBorder: border,
                focusedBorder: border,
                contentPadding: const EdgeInsets.symmetric(
                  horizontal: 12,
                  vertical: 12,
                ),
              ),
            ),
          ],
        ),
      ),
      bottomNavigationBar: Container(
        height: 18,
        color: const Color(0xFF66BFD1),
      ),
    );
  }
}
