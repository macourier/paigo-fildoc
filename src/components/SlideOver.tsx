import React from 'react';
import * as Dialog from '@radix-ui/react-dialog';

interface SlideOverProps {
  open: boolean;
  onClose: () => void;
  draft: Record<string, any>;
  onApply: () => void;
}

const SlideOver: React.FC<SlideOverProps> = ({ open, onClose, draft, onApply }) => {
  return (
    <Dialog.Root open={open} onOpenChange={(isOpen) => { if (!isOpen) onClose(); }}>
      <Dialog.Portal>
        <Dialog.Overlay className="fixed inset-0 bg-black bg-opacity-30" />
        <Dialog.Content className="fixed top-0 right-0 h-full max-w-md w-full bg-white shadow-lg transform transition-transform duration-300 ease-in-out">
          <div className="flex justify-between items-center p-4 border-b">
            <Dialog.Title className="text-lg font-semibold">Action IA</Dialog.Title>
            <Dialog.Close asChild>
              <button aria-label="Close" className="text-gray-500 hover:text-gray-700">✕</button>
            </Dialog.Close>
          </div>
          <div className="p-4 overflow-y-auto h-full">
            <pre className="whitespace-pre-wrap">{JSON.stringify(draft, null, 2)}</pre>
            <button
              className="mt-4 bg-blue-600 text-white rounded px-4 py-2 hover:bg-blue-700"
              onClick={onApply}
            >
              Appliquer
            </button>
          </div>
        </Dialog.Content>
      </Dialog.Portal>
    </Dialog.Root>
  );
};

export default SlideOver;
