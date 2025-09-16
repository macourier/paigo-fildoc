import React from 'react';

interface ChatMessageProps {
  role: 'user' | 'assistant';
  content: string;
}

const ChatMessage: React.FC<ChatMessageProps> = ({ role, content }) => {
  const isUser = role === 'user';
  return (
    <div
      className={`max-w-xs p-3 rounded-lg my-1 ${isUser ? 'bg-blue-500 text-white self-end' : 'bg-gray-200 text-black self-start'}`}
    >
      {content}
    </div>
  );
};

export default ChatMessage;
