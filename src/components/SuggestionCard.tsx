import React from 'react';

interface SuggestionCardProps {
  label: string;
  action: string;
  payload: any;
  onClick?: () => void;
}

const SuggestionCard: React.FC<SuggestionCardProps> = ({ label, action, payload, onClick }) => {
  return (
    <div className="p-4 bg-white rounded shadow-md cursor-pointer" onClick={onClick}>
      <h3 className="text-lg font-semibold mb-2">{label}</h3>
      <p className="text-gray-700 mb-2">Action: {action}</p>
      <pre className="text-sm text-gray-500 overflow-x-auto">{JSON.stringify(payload, null, 2)}</pre>
    </div>
  );
};

export default SuggestionCard;
