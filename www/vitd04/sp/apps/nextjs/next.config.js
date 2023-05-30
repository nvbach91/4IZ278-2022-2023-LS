/** @type {import('next').NextConfig} */
const nextConfig = {
  async rewrites() {
    return [
      {
        source: "/system/:path*",
        destination: process.env.NEXT_PUBLIC_BACKEND_URL + "/:path*", // Proxy to Backend
      },
    ];
  },
};

module.exports = nextConfig;
