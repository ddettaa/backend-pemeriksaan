import 'package:flutter/material.dart';
import 'dart:convert';
import 'package:http/http.dart' as http;

class JadwalDokter {
  final String nama_dokter;
  final String hari;
  final String jam_mulai;
  final String jam_akhir;

  JadwalDokter({
    required this.nama_dokter,
    required this.hari,
    required this.jam_mulai,
    required this.jam_akhir,
  });

  factory JadwalDokter.fromJson(Map<String, dynamic> json) {
    return JadwalDokter(
      nama_dokter: json['nama_dokter'] ?? '',
      hari: json['hari'] ?? '',
      jam_mulai: json['jam_mulai'] ?? '',
      jam_akhir: json['jam_akhir'] ?? '',
    );
  }
}

class DashboardPerawatScreen extends StatefulWidget {
  const DashboardPerawatScreen({super.key});

  @override
  State<DashboardPerawatScreen> createState() => _DashboardPerawatScreenState();
}

class _DashboardPerawatScreenState extends State<DashboardPerawatScreen> {
  late Future<List<JadwalDokter>> _jadwalFuture;

  @override
  void initState() {
    super.initState();
    _jadwalFuture = fetchJadwalDokter();
  }

  Future<List<JadwalDokter>> fetchJadwalDokter() async {
    final response = await http.get(
      Uri.parse('https://ti054a02.agussbn.my.id/api/jadwal-dokter'),
    );
    if (response.statusCode == 200) {
      final body = json.decode(response.body);
      if (body is List) {
        return body.map((e) => JadwalDokter.fromJson(e)).toList();
      } else {
        throw Exception('Format data tidak sesuai');
      }
    } else {
      throw Exception('Gagal memuat data jadwal dokter');
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFF5F5F5),
      appBar: AppBar(
        backgroundColor: Colors.white,
        elevation: 0,
        automaticallyImplyLeading: false,
        centerTitle: false,
        title: const Text(
          'PASIEN RAWAT JALAN (POLI MATA)',
          style: TextStyle(
            color: Colors.black,
            fontWeight: FontWeight.bold,
            fontSize: 14,
          ),
        ),
        actions: const [
          Padding(
            padding: EdgeInsets.only(right: 16.0),
            child: Icon(Icons.health_and_safety, color: Colors.teal, size: 24),
          ),
        ],
      ),
      body: Padding(
        padding: const EdgeInsets.symmetric(horizontal: 16.0, vertical: 8),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Container(
              width: 130,
              height: 80,
              padding: const EdgeInsets.all(12),
              margin: const EdgeInsets.only(top: 12),
              decoration: BoxDecoration(
                color: Colors.blueAccent,
                borderRadius: BorderRadius.circular(12),
              ),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: const [
                  Text(
                    'ANTRIAN',
                    style: TextStyle(
                      color: Colors.white,
                      fontWeight: FontWeight.bold,
                      fontSize: 12,
                    ),
                  ),
                  SizedBox(height: 6),
                  Row(
                    children: [
                      Icon(Icons.people, color: Colors.white, size: 18),
                      SizedBox(width: 6),
                      Text(
                        '0001',
                        style: TextStyle(
                          color: Colors.white,
                          fontSize: 18,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                    ],
                  ),
                ],
              ),
            ),
            const SizedBox(height: 24),
            const Text(
              'JADWAL DOKTER',
              style: TextStyle(fontWeight: FontWeight.bold, fontSize: 14),
            ),
            const SizedBox(height: 8),
            Expanded(
              child: FutureBuilder<List<JadwalDokter>>(
                future: _jadwalFuture,
                builder: (context, snapshot) {
                  if (snapshot.connectionState == ConnectionState.waiting) {
                    return const Center(child: CircularProgressIndicator());
                  } else if (snapshot.hasError) {
                    return Center(child: Text('Gagal memuat jadwal dokter'));
                  } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
                    return Center(child: Text('Tidak ada jadwal dokter'));
                  }

                  final jadwalList = snapshot.data!;
                  return Container(
                    decoration: BoxDecoration(
                      color: Colors.white,
                      border: Border.all(color: Colors.grey.shade300),
                      boxShadow: [
                        BoxShadow(
                          color: Colors.grey.withOpacity(0.2),
                          blurRadius: 4,
                          offset: const Offset(0, 2),
                        ),
                      ],
                    ),
                    child: Table(
                      columnWidths: const {
                        0: FlexColumnWidth(2),
                        1: FlexColumnWidth(1),
                        2: FlexColumnWidth(1),
                      },
                      border: TableBorder.all(color: Colors.grey.shade300),
                      children: [
                        const TableRow(
                          decoration: BoxDecoration(color: Color(0xFF66BFD1)),
                          children: [
                            Padding(
                              padding: EdgeInsets.all(8.0),
                              child: Text(
                                'Nama Dokter',
                                style: TextStyle(fontWeight: FontWeight.bold),
                              ),
                            ),
                            Padding(
                              padding: EdgeInsets.all(8.0),
                              child: Text(
                                'Hari',
                                style: TextStyle(fontWeight: FontWeight.bold),
                              ),
                            ),
                            Padding(
                              padding: EdgeInsets.all(8.0),
                              child: Text(
                                'Jam',
                                style: TextStyle(fontWeight: FontWeight.bold),
                              ),
                            ),
                          ],
                        ),
                        ...jadwalList.map(
                          (jadwal) => TableRow(
                            children: [
                              Padding(
                                padding: const EdgeInsets.all(8.0),
                                child: Text(jadwal.nama_dokter),
                              ),
                              Padding(
                                padding: const EdgeInsets.all(8.0),
                                child: Text(jadwal.hari),
                              ),
                              Padding(
                                padding: const EdgeInsets.all(8.0),
                                child: Text(
                                  '${jadwal.jam_mulai} - ${jadwal.jam_akhir}',
                                ),
                              ),
                            ],
                          ),
                        ),
                      ],
                    ),
                  );
                },
              ),
            ),
          ],
        ),
      ),
      bottomNavigationBar: Container(
        height: 16,
        color: const Color(0xFF66BFD1),
      ),
    );
  }
}
