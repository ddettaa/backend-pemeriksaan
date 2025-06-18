import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:simrs_mobile/perawat/dashboard_perawat_screen.dart';

class LoginPage extends StatefulWidget {
  @override
  State<LoginPage> createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> {
  TextEditingController usernameController = TextEditingController();
  TextEditingController passwordController = TextEditingController();
  bool _showPassword = false;
  bool _loading = false;
  String? _error;

  Future<void> _handleLogin() async {
    setState(() {
      _loading = true;
      _error = null;
    });

    final username = usernameController.text.trim();
    final password = passwordController.text.trim();

    if (username.isEmpty || password.isEmpty) {
      setState(() {
        _error = "Username dan Password tidak boleh kosong";
        _loading = false;
      });
      return;
    }

    try {
      final response = await http.post(
        Uri.parse('https://ti054a02.agussbn.my.id/api/login'),
        headers: {'Content-Type': 'application/json'},
        body: jsonEncode({'username': username, 'password': password}),
      );

      print("Response code: ${response.statusCode}");
      print("Response body: ${response.body}");

      if (response.statusCode == 200) {
        final data = jsonDecode(response.body);
        if (data['status'] == 'success') {
          print("Login sukses, berpindah halaman...");
          if (!mounted) return;

          Future.microtask(() {
            Navigator.pushReplacement(
              context,
              MaterialPageRoute(builder: (_) => const DashboardPerawatScreen()),
            );
          });
        } else {
          setState(() {
            _error = data['message'];
          });
        }
      } else {
        setState(() {
          _error = "Gagal masuk, silakan coba lagi.";
        });
      }
    } catch (e) {
      setState(() {
        _error = "Terjadi kesalahan: $e";
      });
    } finally {
      setState(() {
        _loading = false;
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Stack(
        children: [
          // Background
          Container(
            decoration: const BoxDecoration(
              image: DecorationImage(
                image: AssetImage('assets/logo/login-bg.png'),
                fit: BoxFit.cover,
              ),
            ),
          ),
          const Positioned(
            bottom: 16,
            left: 16,
            child: Image(
              image: AssetImage('assets/logo/logosimrshijau.jpg'),
              width: 56,
              height: 56,
            ),
          ),
          Center(
            child: Container(
              width: 900,
              height: 500,
              decoration: BoxDecoration(
                borderRadius: BorderRadius.circular(30),
                color: Colors.white,
                boxShadow: const [
                  BoxShadow(color: Colors.black26, blurRadius: 10),
                ],
              ),
              child: Row(
                children: [
                  // Gambar dokter
                  Expanded(
                    child: ClipRRect(
                      borderRadius: const BorderRadius.only(
                        topLeft: Radius.circular(30),
                        bottomLeft: Radius.circular(30),
                      ),
                      child: Image.asset(
                        'assets/logo/dokter.jpeg',
                        fit: BoxFit.cover,
                        height: double.infinity,
                      ),
                    ),
                  ),
                  Expanded(
                    child: Padding(
                      padding: const EdgeInsets.all(32.0),
                      child: Column(
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: [
                          const Text(
                            "Selamat Datang",
                            style: TextStyle(
                              fontSize: 24,
                              fontWeight: FontWeight.bold,
                              color: Color(0xFF2e4e4e),
                            ),
                          ),
                          const SizedBox(height: 8),
                          const Text(
                            "Masuk ke akun SIMRS Anda",
                            style: TextStyle(fontSize: 14, color: Colors.grey),
                          ),
                          const SizedBox(height: 24),
                          TextField(
                            controller: usernameController,
                            decoration: const InputDecoration(
                              hintText: 'username',
                              border: UnderlineInputBorder(),
                            ),
                          ),
                          const SizedBox(height: 16),
                          TextField(
                            controller: passwordController,
                            obscureText: !_showPassword,
                            decoration: InputDecoration(
                              hintText: 'Password',
                              border: const UnderlineInputBorder(),
                              suffixIcon: IconButton(
                                icon: Icon(
                                  _showPassword
                                      ? Icons.visibility_off
                                      : Icons.visibility,
                                  size: 18,
                                  color: Colors.grey,
                                ),
                                onPressed: () {
                                  setState(() {
                                    _showPassword = !_showPassword;
                                  });
                                },
                              ),
                            ),
                          ),
                          if (_error != null) ...[
                            const SizedBox(height: 16),
                            Text(
                              _error!,
                              style: const TextStyle(color: Colors.red),
                            ),
                          ],
                          const SizedBox(height: 24),
                          ElevatedButton(
                            onPressed: _loading ? null : _handleLogin,
                            style: ElevatedButton.styleFrom(
                              backgroundColor: const Color(0xFF558c89),
                              foregroundColor: Colors.white,
                              minimumSize: const Size.fromHeight(45),
                              shape: RoundedRectangleBorder(
                                borderRadius: BorderRadius.circular(30),
                              ),
                            ),
                            child: Text(_loading ? "Loading..." : "Login"),
                          ),
                        ],
                      ),
                    ),
                  ),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }
}
