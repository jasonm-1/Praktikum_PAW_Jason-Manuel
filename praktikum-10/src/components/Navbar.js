"use client";
import { useSession, signOut } from "next-auth/react";
import Link from "next/link";
import { useState } from "react";

export default function Navbar() {
  const { data: session } = useSession();
  const [menuOpen, setMenuOpen] = useState(false);

  return (
    <nav className="flex justify-between items-center p-4 bg-white border-b px-8 relative">
      <Link href="/" className="text-2xl font-black text-blue-700 tracking-tighter">
        URBANews
      </Link>

      <div className="flex items-center gap-6">
        {session && (
          <Link href="/add-article" className="text-blue-600 font-medium hover:text-blue-800">
            + Tulis Berita
          </Link>
        )}

        {!session ? (
          <Link href="/login" className="bg-blue-600 text-white px-5 py-2 rounded-full text-sm font-semibold">
            Login
          </Link>
        ) : (
          <div className="relative">
            <button 
              onClick={() => setMenuOpen(!menuOpen)}
              className="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center font-bold text-gray-700 border-2 border-blue-500"
            >
              {session.user.name.charAt(0).toUpperCase()}
            </button>

            {menuOpen && (
              <div className="absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-xl py-2 z-50">
                <div className="px-4 py-2 border-b text-xs text-gray-500">
                  Login sebagai: <br/><span className="font-bold text-gray-800">{session.user.role}</span>
                </div>
                <button className="w-full text-left px-4 py-2 hover:bg-gray-100 text-sm">Edit Profil</button>
                <button 
                  onClick={() => signOut()} 
                  className="w-full text-left px-4 py-2 hover:bg-red-50 text-red-600 text-sm font-bold"
                >
                  Logout
                </button>
              </div>
            )}
          </div>
        )}
      </div>
    </nav>
  );
}
