import 'package:flutter/material.dart';
import 'package:simrs_mobile/perawat/dashboard_perawat_screen.dart';

class RoleSelectionScreen extends StatefulWidget {
  final String token;
  final String role; // Add role parameter

  const RoleSelectionScreen({
    super.key,
    required this.token,
    required this.role,
  });

  @override
  State<RoleSelectionScreen> createState() => _RoleSelectionScreenState();
}

class _RoleSelectionScreenState extends State<RoleSelectionScreen> {
  String? selectedRole;

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      body: SafeArea(
        child: Padding(
          padding: const EdgeInsets.symmetric(horizontal: 24.0),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              const SizedBox(height: 40),
              const Text(
                "Selamat Datang!",
                style: TextStyle(fontSize: 28, fontWeight: FontWeight.bold),
              ),
              const SizedBox(height: 8),
              const Text(
                "Silahkan pilih peran Anda untuk melanjutkan",
                style: TextStyle(fontSize: 16, color: Colors.black54),
              ),
              const SizedBox(height: 40),
              Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  _buildRoleCard(
                    title: "Dokter",
                    icon: Icons.medical_services,
                    isSelected: selectedRole == "DOKTER",
                    onTap:
                        widget.role ==
                                "DOKTER" // Enable only if role matches
                            ? () => setState(() => selectedRole = "DOKTER")
                            : null,
                  ),
                  const SizedBox(width: 16),
                  _buildRoleCard(
                    title: "Perawat",
                    icon: Icons.medical_services,
                    isSelected: selectedRole == "PERAWAT",
                    onTap:
                        widget.role ==
                                "PERAWAT" // Enable only if role matches
                            ? () => setState(() => selectedRole = "PERAWAT")
                            : null,
                  ),
                ],
              ),
              const Spacer(),
              Center(
                child: ElevatedButton(
                  style: ElevatedButton.styleFrom(
                    backgroundColor: const Color(0xFF79B8C0),
                    padding: const EdgeInsets.symmetric(
                      horizontal: 32,
                      vertical: 12,
                    ),
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(30),
                    ),
                  ),
                  onPressed:
                      selectedRole == null
                          ? null
                          : () {
                            if (selectedRole == "PERAWAT") {
                              Navigator.pushReplacement(
                                context,
                                MaterialPageRoute(
                                  builder:
                                      (context) => DashboardPerawatScreen(),
                                ),
                              );
                            } else if (selectedRole == "DOKTER") {
                              Navigator.pushReplacementNamed(
                                context,
                                '/dashboard_dokter',
                              );
                            }
                          },
                  child: const Text(
                    "Selanjutnya",
                    style: TextStyle(fontSize: 16),
                  ),
                ),
              ),
              const SizedBox(height: 40),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildRoleCard({
    required String title,
    required IconData icon,
    required bool isSelected,
    required VoidCallback? onTap,
  }) {
    return GestureDetector(
      onTap: onTap,
      child: AnimatedContainer(
        duration: const Duration(milliseconds: 300),
        width: 120,
        height: 130,
        decoration: BoxDecoration(
          color: isSelected ? const Color(0xFFE8F7F9) : Colors.white,
          borderRadius: BorderRadius.circular(16),
          border: Border.all(
            color: isSelected ? const Color(0xFF79B8C0) : Colors.grey.shade300,
            width: 2,
          ),
          boxShadow: [
            if (isSelected)
              BoxShadow(
                color: Colors.teal.withOpacity(0.2),
                blurRadius: 12,
                offset: const Offset(0, 6),
              ),
          ],
        ),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Icon(
              icon,
              size: 36,
              color: isSelected ? const Color(0xFF479DAE) : Colors.grey,
            ),
            const SizedBox(height: 12),
            Text(
              title,
              style: TextStyle(
                fontSize: 16,
                color: isSelected ? Colors.black : Colors.grey,
                fontWeight: isSelected ? FontWeight.bold : FontWeight.normal,
              ),
            ),
          ],
        ),
      ),
    );
  }
}
