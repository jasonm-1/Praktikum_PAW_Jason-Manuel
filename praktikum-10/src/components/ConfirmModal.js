"use client";
import { useState, useEffect } from "react";

export default function ConfirmModal({ isOpen, onClose, onConfirm, title, message, showReasonInput = false }) {
  const [seconds, setSeconds] = useState(5);
  const [reason, setReason] = useState("");

  useEffect(() => {
    if (isOpen && seconds > 0) {
      const timer = setInterval(() => setSeconds((v) => v - 1), 1000);
      return () => clearInterval(timer);
    }
  }, [isOpen, seconds]);

  if (!isOpen) return null;

  return (
    <div className="fixed inset-0 bg-black/50 flex items-center justify-center z-[100] p-4">
      <div className="bg-white p-6 rounded-xl max-w-md w-full shadow-2xl">
        <h2 className="text-xl font-bold mb-2">{title}</h2>
        <p className="text-gray-600 mb-4">{message}</p>

        {showReasonInput && (
          <textarea 
            placeholder="Alasan penghapusan..."
            className="w-full border p-2 rounded mb-4"
            onChange={(e) => setReason(e.target.value)}
          />
        )}

        <div className="flex gap-3 justify-end">
          <button onClick={onClose} className="px-4 py-2 text-gray-500">Batal</button>
          <button 
            disabled={seconds > 0}
            onClick={() => onConfirm(reason)}
            className={`px-6 py-2 rounded-lg font-bold text-white ${seconds > 0 ? 'bg-red-300' : 'bg-red-600 hover:bg-red-700'}`}
          >
            {seconds > 0 ? `Tunggu ${seconds}s...` : "Ya, Lanjutkan"}
          </button>
        </div>
      </div>
    </div>
  );
}
